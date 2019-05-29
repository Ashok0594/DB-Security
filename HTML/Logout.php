<?php

session_start();
//$username = "ananth";
//$password = "ananth1";
//$hostname = "www.papademas.net:3307";
//$db ="fitb";

$username = "root";
$password = "root";
$hostname = "localhost";
$db ="employees";

$email = $_SESSION['useremail'];
#echo $email;

$conn = mysqli_connect($hostname, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$datetime = date("Y-m-d H:i:s");
$timestamp = $datetime; //in milliseconds

$sql = "UPDATE db_sec_users set LOGOUT_TIME= current_timestamp WHERE Email_id='$email'";

if ($conn->query($sql) === TRUE) {
	#echo "Update success";
	$msg = "Logout Time recorded";
	session_destroy();
    echo '<script type="text/javascript">alert("INFO:  '.$msg.'");window.open("Landing.html","_self");</script>';
}
else
	{
    echo "Error";
	}

$conn->close();


?>
