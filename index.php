
<!doctype html>
  <html>
    <head>
      <link rel="stylesheet" href="node_modules/xterm/dist/xterm.css" />
      <script src="node_modules/xterm/dist/xterm.js"></script>
      <script src="node_modules/xterm/dist/addons/attach/attach.js"></script>
      <script src="node_modules/xterm/dist/addons/fit/fit.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
     
      <div id="serverbox" class="serverbox">
           <?php 
           session_start();
          if (isset($_SESSION['error'])) {?>
			
                            <div class="alert alert-danger" role="alert">
				<h3>
					<?php 
						echo $_SESSION['error']; 
						unset($_SESSION['error']);
					?>
				</h3>
			</div>
          <?php } ?>
          <form action="login.php" method="post">
       <label for="psw"><b>Email</b></label><br>
        <input type="text" id="email" name="email" title="email" placeholder="Enter Email" /><br>
        <label for="psw"><b>Password</b></label><br>
        <input type="password" id="password" name="password" title="password" placeholder="password" /><br>
        <button type="submit" >Login</button><br>
       </form>
      </div>
     
      
    </body>
  </html>
