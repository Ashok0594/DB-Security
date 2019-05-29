<?php
session_start();

$user = $_SESSION['useremail'];
#echo $user;
$userType = $_SESSION['userType'];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>League Page</title>
<link rel="stylesheet" type="text/css" href = "League_css.css">
</head>
<body>


<div id ="heading">

<h1>Database Security Project Page</h1>

</div>


<div id = "menu">

<hr>
</div>


<div id ="choice">
<ul>



<li> <a href = "Logout.php"> Logout</a></li>


<!-- <li> <a href = "../Database/GetParameterValues_Testing.php"> Cron Test</a></li>   -->
<!-- <li> <a href = "../Database/phpFullScript.php"> Cron Test</a></li>  -->

</ul>

</div>


<?php

//$username = "ananth";
//$password = "ananth1";
//$hostname = "www.papademas.net:3307";
//$db ="fitb";

$username = "root";
$password = "root";
$hostname = "localhost";
$db ="employees";
$conn = mysqli_connect($hostname, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = $_SESSION['useremail'];
$query=mysqli_query($conn,"SELECT First_Name, LOGIN_TIME, LOGOUT_TIME FROM db_sec_users WHERE email_id='$email';");

	if (!$query)
	{
    echo 'Could not run query: ' . mysql_error();
    exit;
	}

	$row = mysqli_fetch_array($query);
	if(!$row)
	{
	#	$msg= "No user found for the entered Email-Id";
	#echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../HTML/Registration.html","_self");</script>';
	echo 'Error No row';
	}
	$uName = $row[0];
	$loginTime = $row[1];
	$logoutTime = $row[2];
	$_SESSION['logTime'] = $loginTime;
	$_SESSION['logoTime'] = $logoutTime;
	$_SESSION['fName'] = $uName;
  $_SESSION['utype'] = $userType;

if ($userType == 'U')
{
	echo '<script type="text/javascript">; window.open("../Database/Users.php","_self");</script>';
}
else if ($userType == 'A')
{
	echo '<script type="text/javascript">; window.open("../Database/AdminReports.php","_self");</script>';
}
else if ($userType == 'SU')
{
	echo '<script type="text/javascript">; window.open("../Database/SuperUser.php","_self");</script>';
}
else if ($userType == 'M')
{
	echo '<script type="text/javascript">; window.open("../Database/Manager.php","_self");</script>';
}
else if ($userType == 'HR')
{
	echo '<script type="text/javascript">; window.open("../Database/hr.php","_self");</script>';
}
else
{
	echo "Guest Role";
}
?> </h1>
</body>
</html>
