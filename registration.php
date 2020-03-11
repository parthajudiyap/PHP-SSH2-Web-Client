<?php
 require_once("config.php");
        $provider=$_POST['provider'];
        $connect_method=$_POST['connect_method'];
        $server=$_POST['server'];
        $serverip=$_POST['serverip'];
        $port=$_POST['port'];
        $user=$_POST['user'];
        $password=$_POST['password'];
        
	//$log_in = "select * from login where email='" . $email . "' and password='" . $password . "'";
        $qrry_1 = "insert into serverregistration(`provider`,`connect_method`,`server`,`serverip`,`port`,`user`,`password`)values(";
        $qrry_1 .= "'" . $provider . "',";
        $qrry_1 .= "'" . $connect_method . "',";
        $qrry_1 .= "'" . $server . "',";
        $qrry_1 .= "'" . $serverip . "',";
        $qrry_1 .= "'" . $port . "',";
        $qrry_1 .= "'" . $user . "',";
        $qrry_1 .= "'" . $password . "'";
        $qrry_1 .= ")";
        
        $log_in_rs = mysqli_query($conn, $qrry_1);

        if (mysqli_num_rows($log_in_rs))
        {
            
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Succesfully Registration');
                window.location.href='registration_server.php';
                </script>");
        }
        else
        {
               echo ("<script LANGUAGE='JavaScript'>
                window.alert('Registration failed');
                window.location.href='registration_server.php';
                </script>");
         
        }
	


?>
