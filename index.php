
<?php 
if(isset($_REQUEST['submitBtn'])){
    include 'db/dbconn.php';
    $username=$_REQUEST['uname'];

    $salt="@g26jQsG&nh*&#8v";
    $password= sha1($_REQUEST['pwd'].$salt);
  
    $sql="SELECT email,password FROM customer WHERE email='$username' AND password='$password'";
    $result=mysqli_query($link, $sql) or die(mysqli_error($link));
    $rws=  mysqli_fetch_array($result);
    
    $user=$rws[0];
    $pwd=$rws[1];    
    
    if($user==$username && $pwd==$password){
        session_start();
        $_SESSION['customer_login']=1;
        $_SESSION['cust_id']=$username;
    header('location:customer_account_summary.php'); 
    }
   
else{
    header('location:index.php');  
}}
?>
<?php 
session_start();
        
if(isset($_SESSION['customer_login'])) 
    header('location:customer_account_summary.php');   
?>

<!DOCTYPE html>

<html>
    <head>
        
        <noscript><meta http-equiv="refresh" content="0;url=no-js.php"></noscript>    
        
        
        <meta charset="UTF-8">
        <title>Customer Login - Bank Management System</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <?php include 'header.php' ?>
    <div class="content">
        <div class="user_login">
            <form action='' method='POST'>
                <table align="center">
                    <tr><td><span class="caption">Customer Login</span></td></tr>
                    <tr><td colspan="2"><hr></td></tr>
                    <tr><td>Username:</td></tr>
                    <tr><td><input type="text" name="uname" required></td> </tr>
                    <tr><td>Password:</td></tr>
                    <tr><td><input type="password" name="pwd" required></td></tr>

                    <tr><td class="button1"><input type="submit" name="submitBtn" value="Log In" class="button"></td></tr>
                </table>
            </form>
        </div>
    </div>


            <?php include 'footer.php' ?>
