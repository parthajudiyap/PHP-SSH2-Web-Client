 <?php 
  require_once("config.php");
          session_start();
           if (empty($_SESSION['login'])) 
               {
               header('location:index.php');
           }?>

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
      select
      {
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
  
      
     <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

      </style>
    </head>
    <body>
   
          
           <?php 
             if (isset($_SESSION['success'])) {?>
			
                            <div class="alert alert-success" role="alert">
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
          <?php } ?> <?php 
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
        
        <h3><b>Server List</b></h3>
        <a href="registration_server.php"><button type="button" style="width:10%; float:right" class="btn btn-success">Add Server</button></a>
        <table class="table table-hover">
    <thead>
      <tr>
        <th>provider</th>
        <th>connect_method</th>
        <th>server</th>
        <th>serverip</th>
        <th>port</th>
        <th>user</th>
        <th>password</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM serverregistration";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        ?>
      <tr>
        <td><?php echo $row["provider"]; ?></td>
        <td><?php echo $row["connect_method"]; ?></td>
        <td><?php echo $row["server"]; ?></td>
         <td><?php echo $row["serverip"]; ?></td>
        <td><?php echo $row["port"]; ?></td>
        <td><?php echo $row["user"]; ?></td>
        <td><?php echo $row["password"]; ?></td>
          <input type="hidden" id="server" name="server" value="<?php echo $row["server"]; ?>"/>
          <input type="hidden" min="1" id="port" name="port" value="<?php echo $row["port"]; ?>" />
          <input type="hidden" id="user" name="user"  value="<?php echo $row["user"]; ?>" />
          <input type="hidden" id="password" name="password" value="<?php echo $row["password"]; ?>" />
        <td><button type="button" onclick="ConnectServer()" class="btn btn-success">Connect Server</button></td>
      </tr>
    <?php }} else
{
    ?>
       <tr>
        <td>Data Not Found</td>
       
      </tr>
      <?php
}
?>
    </tbody>
  </table>
      
     
      <div id="terminal" style="width:100%; height:90vh;visibility:hidden"></div>
      <script>
        var resizeInterval;
        var wSocket = new WebSocket("ws:autogitb.dev.pwtech.pw:8080");
        Terminal.applyAddon(attach);  // Apply the `attach` addon
        Terminal.applyAddon(fit);  //Apply the `fit` addon
        var term = new Terminal({
				  cols: 80,
				  rows: 24
        });
        term.open(document.getElementById('terminal'));


        function ConnectServer(){
          document.getElementById("serverbox").style.visibility="hidden";
          document.getElementById("terminal").style.visibility="visible";
          var dataSend = {"auth":
                            {
                            "server":document.getElementById("server").value,
                            "port":document.getElementById("port").value,
                            "user":document.getElementById("user").value,
                            "password":document.getElementById("password").value
                            }
                          };
          wSocket.send(JSON.stringify(dataSend));
          term.fit();
          term.focus();
        }       

        wSocket.onopen = function (event) {
          console.log("Socket Open");
          term.attach(wSocket,false,false);
          window.setInterval(function(){
            wSocket.send(JSON.stringify({"refresh":""}));
          }, 700);
        };

        wSocket.onerror = function (event){
          term.detach(wSocket);
          alert("Connection Closed");
        }        
        
        term.on('data', function (data) {
          var dataSend = {"data":{"data":data}};
          wSocket.send(JSON.stringify(dataSend));
          //Xtermjs with attach dont print zero, so i force. Need to fix it :(
          if (data=="0"){
            term.write(data);
          }
        })
        
        //Execute resize with a timeout
        window.onresize = function() {
          clearTimeout(resizeInterval);
          resizeInterval = setTimeout(resize, 400);
        }
        // Recalculates the terminal Columns / Rows and sends new size to SSH server + xtermjs
        function resize() {
          if (term) {
            term.fit()
          }
        }
      </script>
    </body>
  </html>
