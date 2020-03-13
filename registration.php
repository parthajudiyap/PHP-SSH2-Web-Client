<?php
 require_once("config.php");
        $provider=$_POST['provider'];
        $connect_method=$_POST['connect_method'];
        $server=$_POST['server'];
        $serverip=$_POST['serverip'];
        $port=$_POST['port'];
        $user=$_POST['user'];
        $password=$_POST['password'];
        $key=$_POST['key'];
        
	//$log_in = "select * from login where email='" . $email . "' and password='" . $password . "'";
        $qrry_1 = "insert into serverregistration(`provider`,`connect_method`,`server`,`serverip`,`port`,`user`,`password`,`key`)values(";
        $qrry_1 .= "'" . $provider . "',";
        $qrry_1 .= "'" . $connect_method . "',";
        $qrry_1 .= "'" . $server . "',";
        $qrry_1 .= "'" . $serverip . "',";
        $qrry_1 .= "'" . $port . "',";
        $qrry_1 .= "'" . $user . "',";
        $qrry_1 .= "'" . $password . "',";
        $qrry_1 .= "'" . $key . "'";
        $qrry_1 .= ")";
        
        $log_in_rs = mysqli_query($conn, $qrry_1);

        if ($log_in_rs)
        {
            
            $_SESSION['success']  = "Succesfully Add Server!!";
            header('location:serverlist.php');
        }
        else
        {
            $_SESSION['error']  = "failed Add Server!!";
            header('location:registration_server.php');
         
        }
	


?>
