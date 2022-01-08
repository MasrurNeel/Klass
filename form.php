<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Form In PHP</title>
</head>
<body class="text-center">
<form action="#" method="POST" enctype="multipart/form-data">
    <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
    <label for=inputEmail">Email Address</label>
    <br>
    <input class="form-control" type="email" name="email"
           placeholder="enter your name"
           required autofocus>
    <br>
    <label for="inputPassword">Password</label>
    <br>
    <input class="form_control" type="password" name="password" required>
    <br>
    <label for="inputFile">File</label>
    <br>
    <input class="form_control" type="file" name="file" required>
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
</form>
<?php
if (isset($_POST['email'])) {
    echo 'My Email Address is :' . $_POST['email'] . '<br/>';
    echo 'My Password is :' . $_POST['password'];
    echo "<br/>";
    echo 'My File Name is ' . $_FILES['profile_photo']['name'];
};
echo "<br/>";
//var_dump($_POST['password']);
//var_dump($_FILES);

?>


</body>
</html>

