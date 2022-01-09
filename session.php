<?php
//what is a session?
//used to manage information across difference pages
//verify the user login info
session_start();
$_SESSION['username'] = "Harry";
$_SESSION['favCat'] = "Books";
echo "we have saved your session";

?>