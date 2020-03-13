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
        <th>password / Key</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM serverregistration";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        if(empty($row["password"]))
        {
            $row["password"]='NULL';
        }
         if(empty($row["key"]))
        {
            $row["key"]='NULL';
        }
        ?>
      <tr>
        <td><?php echo $row["provider"]; ?></td>
        <td><?php echo $row["connect_method"]; ?></td>
        <td><?php echo $row["server"]; ?></td>
         <td><?php echo $row["serverip"]; ?></td>
        <td><?php echo $row["port"]; ?></td>
        <td><?php echo $row["user"]; ?></td>
        <td><?php echo $row["password"].'  /  '.$row["key"]; ?></td>
        <td><a href="serverconnect.php?id=<?php echo $row['id'];?>"><button type="button" class="btn btn-success">Connect Server</button></a></td>
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
      
     
      
    </body>
  </html>
