<?php 
session_start();

include 'db/dbconn.php';
$date=$_SESSION['staff_date'];
$id=$_SESSION['id'];
$sql="UPDATE staff SET lastlogin='$date' WHERE id='$id'";
mysqli_query($link, $sql) or die(mysqli_error($link));

session_destroy();
header('location:staff_login.php');
?>