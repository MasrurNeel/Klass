<?php
   //die($_GET['id']);
   $errors =[];
   $id = $_GET['id'] ? $_GET['id'] :  0;

//var_dump((int)($_GET['id']));die();

   if((int)$id === 0){
       //var_dump(is_int($_GET['id']));die();
      header('Location: index.php');
      exit();
   }
$connection = mysqli_connect('localhost', 'root', '', 'llc_php');
if($connection === false){
    $errors['connection'] = mysqli_connect_error();
    exit;
}

if(isset($_POST['update'])){
    if(empty($username)){
        $errors['username'] = 'You must enter your username';
    }
    if(empty($email)){
        $errors['email'] = 'You must enter a valid email';
    }
    if(empty($errors)){
        
    }
}



if(!isset($errors['connection'])){
    $query = "SELECT username, email, profile_photo FROM mas WHERE id='$id'";
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

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Update</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
</form>

</body>
</html>