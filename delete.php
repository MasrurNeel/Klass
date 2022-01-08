<?php
$id = $_GET['id'] ? $_GET['id'] :  0;

if((int)$id === 0){
    header('Location: users.php');
}
$connection = mysqli_connect('localhost', 'root', '', 'llc_php');
if($connection === false){
    $errors['connection'] = mysqli_connect_error();
}else{
    $query ="DELETE FROM mas WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    header('Location: users.php');
}
?>
