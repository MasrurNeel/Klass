<?php
session_start();
// var_dump($_SESSION);
   //die($_GET['id']);
   $errors =[];
   $id = $_GET['id'] ? $_GET['id'] :  0;
if((int)$id === 0){
      header('Location: index.php');
      exit();
   }
//$connection = mysqli_connect('localhost', 'root', '', 'llc_php');
//if($connection === false){
//    $errors['connection'] = mysqli_connect_error();
//    exit;
//}
include_once 'connection.php';

if(isset($_POST['update'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $profile_photo = $_FILES['file'];
    $message = '';
    $type = '';

    if(empty($username)){
        $type = 'data error';
        $message = 'You must enter your username';
    }
    if(empty($email)){
        $type = 'data error';
        $message = 'You must enter a valid email';
    }
    if(empty($errors)){
        if(!empty($profile_photo['name'])){
            $file_info =explode('.', $profile_photo['name']);
            $file_ext = end($file_info);

            if(!in_array($file_ext, ['jpg','png'], true)){
                $type = 'data error';
                $message = 'file is not provided';
            }
            if(!isset($errors['profile_photo'])){
                $new_file_name =uniqid('pp_', true). '.' . $file_ext;
                move_uploaded_file($profile_photo['tmp_name'],'profile_photo/' . $new_file_name);

                $query ="UPDATE mas SET profile_photo = :profile_photo WHERE id = :id";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(':profile_photo', $new_file_name);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                //$result = mysqli_query($connection, $query);
            }
        }
        $query ="UPDATE mas SET username = :username, email = :email WHERE id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        //$result = mysqli_query($connection, $query);

//        if($result === true){
           $success = "User data updated";
//        }else{
//            $errors[] = mysqli_error($connection);
//        }
    }if(isset($_SESSION['message'], $_SESSION['type'])) {
        echo $_SESSION['message'];

        $_SESSION['message'] = 'edit not successful';
        $_SESSION['type']  = 'warning';

        header('Location: users.php');
        exit();
    }
    $_SESSION['message'] = 'edit not successful';
    $_SESSION['type']  = 'warning';

    header('Location: users.php');
    exit();
}


if(!isset($errors['connection'])){
    $query = "SELECT username, email, profile_photo FROM mas WHERE id=':id'";
    $stmt = $connection->prepare($query);
    $stmt->bindParam('id',$id, PDO::PARAM_INT);

    $stmt->execute();
    $data = $stmt->fetch();
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)=== 0){
       header('Location: index.php');
    }
    $data = mysqli_fetch_assoc($result);

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Form In PHP</title>
</head>
<body class="text-center">
<?php
     if(isset($success)){
         ?>
    <div class="alert alert-success">
        <?php echo $success;?>
    </div>
    <?php
}
?>

<?php
if(!empty($errors)){
    ?>
<div class="alert alert-warning">
    <?php
    foreach ($errors as $error){
        ?>
    <ul>
        <li><?php echo $error;  ?></li>
    </ul>
    <?php
    }
    ?>
</div>
<?php
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 font-weight-normal">Edit Profile</h1>
    <label for=inputUsername">Username (*)</label>
    <br>
    <input class="form-control" type="text" name="username"
           value = "<?php echo $data['username'];?>" placeholder="enter your name"
           required autofocus>
    <br>

    <label for=inputEmail">Email Address(*)
    <input class="form-control" type="email" name="email"
           value = "<?php echo $data['email'];?>" placeholder="enter your email"
           required autofocus>
    <br>

    <label for="inputFile">Profile Photo</label>
        <br>
    <input class="form_control" type="file" name="file" required>
    <br>
        <p class="img"><img src="profile_photo/<?php echo $data['profile_photo'];?>" width="70px"></p>

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="update">Update</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
</form>
<?php unset($_SESSION['message'],$_SESSION['type']);?>
</body>
</html>