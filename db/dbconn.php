<?php
    $server="localhost";
    $dbuser="root";
    $dbpassword="";
    $dbname="bank_db";

    $link = mysqli_connect($server,$dbuser,$dbpassword) or die('Database connection error');

    mysqli_select_db($link, $dbname) or die(mysqli_error($link));
?>