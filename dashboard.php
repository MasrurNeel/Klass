<?php
session_start();
if(!isset($_SESSION['id'], $_SESSION['username'])){
    header('Location: login.php');

}
include_once 'connection.php';
if(isset($_POST['update'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $profile_photo = $_FILES['file'];
    $message = '';
    $type = '';

    if (empty($username)) {
        $type = 'data error';
        $message = 'You must enter your username';
    }
    if (empty($email)) {
        $type = 'data error';
        $message = 'You must enter a valid email';
    }
    if (empty($errors)) {
        if (!empty($profile_photo['name'])) {
            $file_info = explode('.', $profile_photo['name']);
            $file_ext = end($file_info);

            if (!in_array($file_ext, ['jpg', 'png'], true)) {
                $type = 'data error';
                $message = 'file is not provided';
            }
            if (!isset($errors['profile_photo'])) {
                $new_file_name = uniqid('pp_', true) . '.' . $file_ext;
                move_uploaded_file($profile_photo['tmp_name'], 'profile_photo/' . $new_file_name);

                $query = "UPDATE mas SET profile_photo = :profile_photo WHERE id = :id";
                $connection->prepare($query);
                $stmt->bindParam(':profile_photo', $new_file_name);
                $stmt->bindParam("id", $_SESSION['id'], PDO::PARAM_INT);
                $stmt->execute();
                //$result = mysqli_query($connection, $query);
            }
        }
        $query = "UPDATE mas SET username = :username, email = :email WHERE id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['username'] = $username;

//$connection = mysqli_connect('localhost', 'root', '', 'llc_php');
//
//if($connection === false){
//    $errors[] = mysqli_connect_error();
//    exit;
//}else{
//$query = "SELECT id, username, email, password, profile_photo FROM `mas`";
//$stmt = $connection->prepare($query);
//$stmt->execute();
        $data = $stmt->fetch();
    }

//$result = mysqli_query($connection, $query);
//$data = mysqli_fetch_all($result, 1);

    $query_string = '';
    if (isset($_GET['search'])) {
        $query_string = trim($_GET['query']);
        $query = "SELECT id, username, email, password, profile_photo FROM `mas` WHERE username LIKE '%$query_string%' OR email LIKE '%$query_string%'";
        $result = mysqli_query($connection, $query);
        $data = mysqli_fetch_all($result, 1);

        if (isset($_SESSION['message'], $_SESSION['type'])) {
            echo $_SESSION['message'];
        }
    }
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
<div class="well">
    <h2>You are logged in as. <?php echo $_SESSION['username']; ?> </h2>
</div>
<div class="well">
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
</div>
<a href="logout.php" class=""btn btn-block btn-danger></a>

</body>
</html>