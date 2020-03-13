 <?php 
  require_once("config.php");
include('phpseclib/Crypt/RSA.php');
include('phpseclib/Crypt/Base.php');
include('phpseclib/Crypt/RC4.php');
include('phpseclib/Crypt/Rijndael.php');
include('phpseclib/Crypt/Twofish.php');
include('phpseclib/Crypt/Blowfish.php');
include('phpseclib/Crypt/TripleDES.php');
include('phpseclib/Math/BigInteger.php');
include('phpseclib/Net/SSH2.php');
          session_start();
           if (empty($_SESSION['login'])) 
               {
               header('location:index.php');
           }


        
$sql = "SELECT * FROM serverregistration where id='".$_GET['id']."'";
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$server=$result['server'];
$port=$result['port'];
$user=$result['user'];
$password=$result['password'];
$connect_method=$result['connect_method'];

//Username and Password

if($connect_method == "password")
{
        $ssh = new Net_SSH2($server);
        if (!$ssh->login($user, $password)) {
            exit('Login Failed');
        }

        echo $ssh->exec('pwd');
        echo "<br>";
        echo $ssh->exec('ls');
        echo "<br>";
        echo $ssh->exec('cd public_html');
        echo "<br>";
}

//RSA key
if($connect_method == "sshkey")
{
        $key = new RSA();
        $key->loadKey(file_get_contents('privatekey'));

        //Remote server's ip address or hostname
        $ssh = new SSH2($server);

        if (!$ssh->login($user, $key)) {
            exit('Login Failed');
        }

        echo $ssh->exec('pwd');
        echo "<br>";
        echo $ssh->exec('ls');
        echo "<br>";
        echo $ssh->exec('cd public_html');
        echo "<br>";
}

//Password Protected RSA Key

if($connect_method == "sshkewith_password")
{
        $key = new RSA();
        $key->setPassword($password);
        $key->loadKey(file_get_contents('privatekey'));

        //Remote server's ip address or hostname
        $ssh = new SSH2($server);

        if (!$ssh->login($user, $key)) {
            exit('Login Failed');
        }

        echo $ssh->exec('pwd');
        echo "<br>";
        echo $ssh->exec('ls');
        echo "<br>";
        echo $ssh->exec('cd public_html');
        echo "<br>";
}
?>
