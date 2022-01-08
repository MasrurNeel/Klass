<?php
    $connection = mysqli_connect('localhost', 'root', '', 'llc_php');

if($connection === false){
    $errors[] = mysqli_connect_error();
    exit;
}else{
$query = "SELECT id, username, email, password, profile_photo FROM `mas` ORDER BY id DESC";
$result = mysqli_query($connection, $query);
$data = mysqli_fetch_all($result, 1);
}
$query_string = '';
if(isset($_GET['search'])){
    $query_string = trim($_GET['query']);

    $query = "SELECT id, username, email, password, profile_photo FROM `mas` WHERE username LIKE '%$query_string%' OR email LIKE '%$query_string%' ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_all($result, 1);
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
<form action="" method="get" class="form form-horizontal">
    <label for=input">Search</label>
    <br>
    <input class="form-control" type="text" name="query"
           placeholder="explore into info" value = "<?php echo $query_string ?? '';?>" autofocus>
    <button class="btn btn-info btn-block" type="submit" name="search">Search</button>
</form>
<?php if(!empty($query_string)){ ?>
    <div class="alert alert-info">
        You have search for <i><?php echo $query_string; ?></i>
    </div>
<?php } ?>
<?php if(count($data)>0){?>
<table class="table table-bordered">
    <thead>
    <tr style="color : saddlebrown">
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

        <td>
            <?php echo !empty($query_string) ? str_replace($query_string, '<span style = "color: #ff0000;">' . $query_string . '</span>', $user['username']) : $user['username'];
            ?>
        </td>

        <td>
            <?php echo !empty($query_string) ? str_replace($query_string, '<span style = "color: #ff0000;">' . $query_string . '</span>', $user['email']) : $user['email'];
            ?>
        </td>

        <td><img src="profile_photo/<?php echo $user['profile_photo']; ?>" width="70px"></td>
        <td><a href="edit.php?id=<?php echo $user['id']; ?>" class="label label-info" style="background-color : darkgreen">Edit</a>
            <a href="delete.php?id=<?php echo $user['id']; ?>" class="label label-danger" onclick="confirm('Are you sure')" style="background-color : red">Delete</a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<?php } else { ?>
<div class="alert alert-warning">
    Sorry! No data found.
</div>
<?php } ?>
</body>
</html>