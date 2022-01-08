<?php
$errors =[];

//var_dump($_POST);

if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $profile_photo = $_FILES['file'];

    //var_dump($profile_photo);
    //exit();

    //validation
    if(empty($username)){
        $errors['username'] = 'You must enter your username';
    }
    if(empty($email)){
        $errors['email'] = 'You must enter a valid email';
    }
    if(empty($password)){
        $errors['password'] = 'You must enter a password';
    }
    if(empty($profile_photo['name'])){
        $errors['profile_photo'] = 'File must be provided';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
        $errors['email'] = "You must enter a valid email";
    }
    if(strlen($password)<6){
        $errors['password'] = 'You must enter a password containing at least 6 chars.';
    }

    $password = password_hash($password, PASSWORD_BCRYPT);

    //var_dump($errors);
    if(empty($errors)){

        //mysql connection
        $connection = mysqli_connect('localhost', 'root', '', 'llc_php');

        //var_dump($connection);

        if($connection === false){
            $errors = mysqli_connect_error();
            exit();
        }

        //profile_photo upload
        $file_info =explode('.', $profile_photo['name']);
        $file_ext = end($file_info);
        if(!in_array($file_ext, ['jpg','png'], true)){
            $errors[]= 'File must be a valid image profile_photo';
        }

        $new_file_name =uniqid('pp_', true). '.' . $file_ext;
        $upload = move_uploaded_file($profile_photo['tmp_name'],'profile_photo/' . $new_file_name);

        if($upload){
            //do insert
            $sql = "INSERT INTO `mas` (`username`, `email`, `password`, `profile_photo`) VALUES ('$username', '$email', '$password', '$new_file_name')";
            $insert = mysqli_query($connection, $sql);

            //var_dump($insert);

            if($insert === true){
                $success ='User inserted successfully';
            }else{
                die(mysqli_error($connection));
            }

            //die();
            //mysqli_stmt_execute($sql);

        }else{
            $errors[] = 'profile_photo was not uploaded';
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
<?php
if(isset($success)){
    ?>
    <p class="alert alert-success">
        <?php echo $success;?>
    </p>
    <?php
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>

    <label for=inputUsername">Username</label>
    <br>
    <input class="form-control" type="text" name="username"
           placeholder="enter your name"
           required autofocus>
    <?php
    if(isset($errors['username'])){
        ?>
        <p class="alert alert-warning">
            <?php echo $errors['username'];?>
        </p>
        <?php
    }
    ?>
    <br>

    <label for=inputEmail">Email Address</label>
    <br>
    <input class="form-control" type="email" name="email"
           placeholder="enter your email"
           required autofocus>
    <?php
    if(isset($errors['email'])){
        ?>
        <p class="alert alert-warning">
            <?php echo $errors['email'];?>
        </p>
        <?php
    }
    ?>
    <br>

    <label for="inputPassword">Password</label>
    <br>
    <input class="form_control" type="password" name="password" required>
    <?php
    if(isset($errors['password'])){
        ?>
        <p class="alert alert-warning">
            <?php echo $errors['password'];?>
        </p>
        <?php
    }
    ?>
    <br>

<label for="inputFile">Profile Photo</label>
    <br>
    <input class="form_control" type="file" name="file" required>
    <?php
      if(isset($errors['profile_photo'])){
      ?>
    <p class="alert alert-warning">
        <?php echo $errors['profile_photo'];?>
    </p>
    <?php
      }
    ?>
    <br>

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
</form>

</body>
</html>