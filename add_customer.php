<?php 
session_start();
        
if(!isset($_SESSION['admin_login'])) 
    header('location:adminlogin.php');   
?>
    <?php
include 'db/dbconn.php';
$name=  mysqli_real_escape_string($link, $_REQUEST['customer_name']);
$gender=  mysqli_real_escape_string($link, $_REQUEST['customer_gender']);
$dob=  mysqli_real_escape_string($link, $_REQUEST['customer_dob']);
$nominee=  mysqli_real_escape_string($link, $_REQUEST['customer_nominee']);
$type=  mysqli_real_escape_string($link, $_REQUEST['customer_account']);
$credit=  mysqli_real_escape_string($link, $_REQUEST['initial']);
$address=  mysqli_real_escape_string($link, $_REQUEST['customer_address']);
$mobile=  mysqli_real_escape_string($link, $_REQUEST['customer_mobile']);
$email= mysqli_real_escape_string($link, $_REQUEST['customer_email']);

$salt="@g26jQsG&nh*&#8v";
$password=  sha1($_REQUEST['customer_pwd'].$salt);

$branch=  mysqli_real_escape_string($link, $_REQUEST['branch']);
$date=date("Y-m-d");
switch($branch){
case 'Dhaka': $bic="K421A";
    break;
case 'Khulna': $bic="D30AC";
    break;
case 'Barisal': $bic="B6A9E";
    break;
}

$sql3="SELECT MAX(id) from customer";
$result=mysqli_query($link, $sql3) or die(mysqli_error($link));
$rws=  mysqli_fetch_array($result);
$id=$rws[0]+1;
$sql1="CREATE TABLE passbook".$id." 
    (transactionid int(5) AUTO_INCREMENT, transactiondate date, name VARCHAR(255), branch VARCHAR(255), bic VARCHAR(255), credit int(10), debit int(10), 
    amount float(10,2), narration VARCHAR(255), PRIMARY KEY (transactionid))";

$sql="insert into customer values('','$name','$gender','$dob','$nominee','$type','$address','$mobile',
    '$email','$password','$branch','$bic','','ACTIVE')";
mysqli_query($link, $sql) or die("Email already exists!");
mysqli_query($link, $sql1) or die(mysqli_error($link));
$sql4="insert into passbook".$id." values('','$date','$name','$branch','$bic','$credit','0','$credit','Account Open')";
mysqli_query($link, $sql4) or die(mysqli_error($link));
header('location:admin_homepage.php');
?>