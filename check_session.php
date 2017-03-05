<? 
session_start();
$expireAfter = 30;
if(!isset($_SESSION['name']))

{
		echo "<script>alert('Please login to system'); </script>";
		print "<meta http-equiv='refresh' content='1;URL=login.php'>";
		exit();
}

if(isset($_SESSION['last_action'])){
    $secondsInactive = time() - $_SESSION['last_action'];
    $expireAfterSeconds = $expireAfter * 60;
    if($secondsInactive >= $expireAfterSeconds){

        session_unset();
        session_destroy(); 
        echo "<script>alert('Session timeout'); </script>";
        print "<meta http-equiv='refresh' content='0;URL=login.php'>";
        exit();

    }
    
}
$_SESSION['last_action'] = time();

?>