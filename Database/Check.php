<?php
session_start();
//$username = "ananth";
//$password = "ananth1";
//$hostname = "www.papademas.net:3307";
//$db ="fitb";

$username = $_SESSION['uname'];
$password = "root";
$hostname = "localhost";
$db ="employees";


$query = $_POST['query'];

$conn = mysqli_connect($hostname, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($username == 'root')
{
	$callback="AdminReports";
}
else if ($username == 'User')
{
	$callback="Users";
}
else if ($username == 'hr')
{
  $callback="hr";
}
else if ($username == 'Manager')
{
	$callback="Manager";
}
else if ($username == 'SuperUser')
{
  $callback="SuperUser";
}
else
{
	$callback="Users";
}

try {
$sql=mysqli_query($conn,$query);

	if (!$sql)
	{
    $msg= "Not authorized to run the query entered.";
  echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../Database/'.$callback.'.php","_self");</script>';
    exit;
	}
  else {
    $msg= "Query executed successfully. You have all privileges to run the query enterd.";
  echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../Database/'.$callback.'.php","_self");</script>';
  }
echo '<!DOCTYPE html><html><head><meta charset="ISO-8859-1"><title>Databse user Details </title>';
echo '<link rel="stylesheet" type="text/css" href="../HTML/JoinLeague_css.css">';
echo '</head><body>';
echo $query;
}catch(Exception $e){
  echo '<script type="text/javascript">alert("Error in SQL '.$e.'"); window.open("../Database/Users.php","_self");</script>';
}
//$conn = mysqli_connect($hostname, $username, $password, $db);
// Check connection

//echo '<script type="text/javascript">alert("INFO:  '.$email.'"); window.open("../HTML/Registration.html","_self");</script>';
echo '</body></html>';


echo 'Here';

?>
<!DOCTYPE html>
<html>
<head>

<title>Report Page</title>
<link rel="stylesheet" type="text/css" href = "../HTML/League_css.css">
</head>
<body>
</body>
</html>
