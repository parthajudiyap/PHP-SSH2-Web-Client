<?php
 require_once("config.php");
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        
	$log_in = "select * from login where email='" . $email . "' and password='" . $password . "'";
        $log_in_rs = mysqli_query($conn, $log_in);

        if (mysqli_num_rows($log_in_rs))
        {
            
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Succesfully Login');
                window.location.href='registration_server.html';
                </script>");
        }
        else
        {
               echo ("<script LANGUAGE='JavaScript'>
                window.alert('login failed');
                window.location.href='index.html';
                </script>");
         
        }
	


?>
