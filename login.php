<?php
session_start();
$errors =[];

//var_dump($_POST);

if(isset($_POST['login'])){
    $identifier = trim($_POST['identifier']);
    $password = trim($_POST['password']);
    //validation

    if(empty($identifier)){
        $errors['identifier'] = 'Username/Email can not be empty';
    }
    if(empty($password)){
        $errors['password'] = 'You must enter a password';
    }

    if(empty($errors)) {
        include 'connection.php';
        //$connection = mysqli_connect('localhost', 'root', '', 'llc_php');

        $query = "SELECT id, password FROM `mas` WHERE `username` :$identifier OR `email` = :identifier";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':identifier', $identifier);
        $stmt->execute();
//            $result = mysqli_query($connection, $query);
//            $data = mysqli_fetch_assoc($result);

        if ($stmt->rowCount()===0) {
            $errors[] = 'Users not found';
        } else {
            $data = $stmt->fetch();

            if (password_verify($password, $data['password'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['username'] =$data['username'];
                $_SESSION['message'] = 'Logged in successfully';

                header('Location: dashboard.php');
                $success = "You have been logged in";
            } else {
                $errors[] = 'Wrong Password';
            }
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
    <h1 class="h3 mb-3 font-weight-normal">Log in</h1>

    <label for=inputUsername">Username/Email</label>
    <br>
    <input class="form-control" type="text" name="identifier"
           placeholder="enter your name"
           required autofocus>
    <br>

    <label for="inputPassword">Password</label>
    <br>
    <input class="form_control" type="password" name="password" required>
    <br>

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Log in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
</form>

</body>
</html>