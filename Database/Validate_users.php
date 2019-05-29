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

if(isset($_POST['usubmit']))
{
$email = $_POST['uname'];
$pass = $_POST['upass'];



$conn = mysqli_connect($hostname, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query=mysqli_query($conn,"SELECT Email_id, Password, userType, account_status,login_attempts FROM db_sec_users WHERE email_id='$email';");

	if (!$query)
	{
    echo 'Could not run query: ' . mysql_error();
    exit;
	}

	$row = mysqli_fetch_array($query);
	if(!$row)
	{
		$msg= "No user found for the entered Email-Id";
	echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../HTML/Registration.html","_self");</script>';
	}
	$dbuserName = $row[0];
	$dbpassword = $row[1];
	$dbusertype = $row[2];
	$dbaccountstatus = $row[3];
	$dbloginattempts = $row[4];

	if (password_verify($pass,$dbpassword))
	{
	$_SESSION['useremail'] = $email;
	$_SESSION['userType'] = $dbusertype;
		#echo $dbaccountstatus;
		if ($dbaccountstatus != 'N')
		{
		$msg= " Account Locked. Please contact the Admin";
		echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../HTML/Sign_in.html","_self");</script>';
		}
		else
		{
		$msg= "Success You can login";

		$sql = "UPDATE db_sec_users set LOGIN_TIME= current_timestamp WHERE Email_id='$email'";

		if ($conn->query($sql) === TRUE) {
			#echo "Update success";
			$msg = "Login Time recorded";
			#session_destroy();
			echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../HTML/League_Page.php","_self");</script>';
		}

		}


	}
	else

		{
				$username = "ananth";
$password = "ananth1";
$hostname = "www.papademas.net:3307";
$db ="fitb";

		   $query_fetch=mysqli_query($conn,"SELECT login_attempts FROM db_sec_users WHERE email_id='$email';");
		   $row = mysqli_fetch_array($query_fetch);
			$dbloginattempts_updated = $row[0];

			if ($dbloginattempts_updated >=3)
			{
				$sql = "update db_sec_users set account_status = 'Y' WHERE email_id='$email';";
				$msg= " Crossed the maximum limit. Your accout has been locked";
						if ($conn->query($sql) === TRUE)
						{
						$msg= " Crossed the maximum limit. Your accout has been locked";
						echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../HTML/Sign_in.html","_self");</script>';

						}
						else
						{
						#echo "Error: " . $sql . "<br>" . $conn->error;
						$errormsg = $conn->error;
						echo $errormsg;
						#$row = substr($errormsg,0,15);
						}

		        echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../HTML/Landing.html","_self");</script>';
			}
			else
			{

			$msg= "Invalid passwords and updating attemps";
			$sql = "update db_sec_users set login_attempts = login_attempts+1 WHERE email_id='$email';";
				if ($conn->query($sql) === TRUE)
				{
				$msg = "Invalid Login attempts updated ";
				echo '<script type="text/javascript">alert("INFO:  '.$msg.'"); window.open("../HTML/Sign_in.html","_self");</script>';

				}
				else
				{
				#echo "Error: " . $sql . "<br>" . $conn->error;
				$errormsg = $conn->error;
				echo $errormsg;
				#$row = substr($errormsg,0,15);
				}
			}
		}

}




?>
