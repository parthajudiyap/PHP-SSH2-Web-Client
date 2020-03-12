<?php
session_start();
 require_once("config.php");
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        
	$log_in = "select * from login where email='" . $email . "' and password='" . $password . "'";
        $log_in_rs = mysqli_query($conn, $log_in);

        if (mysqli_num_rows($log_in_rs))
        {
            $_SESSION['login'] ="login";
          
            $_SESSION['success']  = "Succesfully Login!!";
            header('location:serverlist.php');
        }
        else
        {
            $_SESSION['error']  = "Login failed!";
            header('location:index.php');
         
        }
	


?>
