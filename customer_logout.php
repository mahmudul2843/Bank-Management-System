<?php 
session_start();

include 'db/dbconn.php';

$date=date('Y-m-d h:i:s');
$id=$_SESSION['login_id'];
$sql="UPDATE customer SET lastlogin='$date' WHERE id='$id'";
mysqli_query($link, $sql) or die(mysqli_error($link));

session_destroy();
header('location:index.php');
?>