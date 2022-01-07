<?php
    $connection = mysqli_connect('localhost', 'root', '', 'llc_php');

if($connection === false){
    $errors[] = mysqli_connect_error();
    exit;
}else{
$query = "SELECT id, username, email, password, profile_photo FROM `mas`";
$result = mysqli_query($connection, $query);
$data = mysqli_fetch_all($result, 1);
 //var_dump($data);die();
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

<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Profile Photo</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data as $user) { ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><img src="profile_photo/<?php echo $user['profile_photo']; ?>" width="70px"></td>
        <td><a href="edit.php?id=<?php echo $user['id']; ?>" class="label label-info">Edit</a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>



</body>
</html>