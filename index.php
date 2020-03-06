<?php
 require_once("config.php");
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        
	$log_in = "select * from login where email='" . $email . "' and password='" . $password . "'";
        $log_in_rs = mysqli_query($conn, $log_in);

        if (mysqli_num_rows($log_in_rs))
        {
            //echo "login successfully";
            $_SESSION["success"]="login successfully";
            header('Location:registration_server.html');
        }
        else
        {
            //echo "login failed";
            $_SESSION["error"]="login failed";
            header('Location:index.html');
        }
	


?>
<!doctype html>
  <html>
    <head>
      <link rel="stylesheet" href="node_modules/xterm/dist/xterm.css" />
      <script src="node_modules/xterm/dist/xterm.js"></script>
      <script src="node_modules/xterm/dist/addons/attach/attach.js"></script>
      <script src="node_modules/xterm/dist/addons/fit/fit.js"></script>
      <style>
      body {font-family: Arial, Helvetica, sans-serif;}

      input[type=text], input[type=password], input[type=number] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
      }

      button {
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 100%;
      }

      button:hover {
          opacity: 0.8;
      }

      .serverbox {
          padding: 16px;
          border: 3px solid #f1f1f1;
          width: 25%;
          position: absolute;
          top: 15%;
          left: 37%;
      }
      </style>
    </head>
    <body>
       <div class="alert alert-danger alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
  </div> 
      <div id="serverbox" class="serverbox">
       <form action="" method="post">
       <label for="psw"><b>Email</b></label><br>
        <input type="text" id="email" name="email" title="email" placeholder="Enter Email" /><br>
        <label for="psw"><b>Password</b></label><br>
        <input type="password" id="password" name="password" title="password" placeholder="password" /><br>
        <button type="submit" >Login</button><br>
       </form>
      </div>
     
      
    </body>
  </html>
