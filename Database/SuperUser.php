<?php

session_start();

$user = $_SESSION['useremail'];
$loginnTime = $_SESSION['logTime'];
$logooutTime = $_SESSION['logoTime'];
$name = $_SESSION['fName'];
#echo $name;
#echo

//$username = "ananth";
//$password = "ananth1";
//$hostname = "www.papademas.net:3307";
//$db ="fitb";

$username = "SuperUser";
$password = "root";
$_SESSION['uname']=$username;
$hostname = "localhost";
$db ="employees";
$conn = mysqli_connect($hostname, $username, $password, $db);
// Check connection
if ($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
exit();

}

$Color = "#ff6600";

echo '<div id ="head"><h1>Super User Home page</h1><hr></div>';
echo '<div id = "menu"></div><div id ="choice">';
echo '<ul>';
echo '<li> <a href = ""> Welcome' . "  " . $name . '</a></li>';
echo '<li> <a href = "../HTML/Logout.php"> Logout</a></li>';
echo '<li> <a href = "../HTML/Project.html"> Project Details</a></li>';
echo '</ul></div>';

echo '<!DOCTYPE html><html><head><meta charset="ISO-8859-1"><title>Databse user Details </title>';
echo '<link rel="stylesheet" type="text/css" href="../HTML/JoinLeague_css.css">';
echo '</head><body>';

echo '<p class = "sysnot" style="Color:'.$Color.'">'.'The Information contained in this system is proprietary to the organization. Only authorized users may access the information contained in this system.
By accessing this information each authorized user acknowledges that such information is confidential and proprietary to the organization
and shall not be disclosed unless necessary in the course of organization business.'.'</p>';
echo '<p class="tab">Logged in with <b>SuperUser Privileges</b></p>';
echo '<p class="tab">Your Last Login Time was <b style="Color:'.$Color.'">'.$loginnTime .'</b></p>';
echo '<p class="tab">Your Last Logout Time was <b style="Color:'.$Color.'">'.$logooutTime .'</b></p>';

echo '<div style="text-align:center">'.'<form name="q" method="post" action="../Database/Check.php" >'.
'<p class="center" >Query</p>'.
'<input type="text" name="query" id="query" style="width:1000px; height:50px;" required="required"/><br><br>'.

'<button type="submit" name="Enter" id="Enter" value="Enter"'.
' style="border-radius: 10px;background-color: #ff6600;border: none;font-size: 16px;color:#001a33;padding: 10px 100px;" />Execute</button>'.
'</form>'.'</div>';

//*****************Table1
$query ="SELECT
User_id,
Email_id,
First_Name,
Last_Name,
LOGOUT_TIME,
userType,
account_status,
login_attempts,
LOGIN_TIME
FROM db_sec_users
where UserType not in ('A','SU')
order by 1;";

$data = mysqli_query($conn,$query);

echo '<p class="center" >Database User log information</p>';

echo  '<table>';
echo '<tr>';
echo '<th>UserID</th>';
echo '<th>EmailID</th>';
echo '<th>First Name</th>';
echo '<th>Last Name</th>';
echo '<th>Logout Time</th>';
echo '<th>User Type</th>';
echo '<th>Account Status</th>';
echo '<th>Login Attempts</th>';
echo '<th>Login Time</th>';

echo '</tr>';
while($row = mysqli_fetch_array($data))
{
echo '<tr>';
echo '<td>' . $row['User_id'] . '</td>';
echo '<td>' . $row['Email_id'] . '</td>';
echo '<td>' . $row['First_Name'] . '</td>';
echo '<td>' . $row['Last_Name'] . '</td>';
echo '<td>' . $row['LOGOUT_TIME'] . '</td>';
echo '<td>' . $row['userType'] . '</td>';
echo '<td>' . $row['account_status'] . '</td>';
echo '<td>' . $row['login_attempts'] . '</td>';
echo '<td>' . $row['LOGIN_TIME'] . '</td>';
echo '</tr>';
}
echo '</table>';
echo '</body></html>';

//********************Table 1
$query ="SELECT SUBSTRING_INDEX(host, ':', 1) AS host_short,
       GROUP_CONCAT(DISTINCT user) AS us,
       COUNT(*) AS threads
FROM information_schema.processlist
WHERE user not in ('event_scheduler')
GROUP BY host_short
ORDER BY COUNT(*), host_short;";

$data = mysqli_query($conn,$query);

echo '<p class="center" >Active Users logged into the Database</p>';

echo  '<table>';
echo '<tr>';
echo '<th>Host Name</th>';
echo '<th>Active User</th>';
echo '<th>Active Threads</th>';

echo '</tr>';
while($row = mysqli_fetch_array($data))
{
echo '<tr>';
echo '<td>' . $row['host_short'] . '</td>';
echo '<td>' . $row['us'] . '</td>';
echo '<td>' . $row['threads'] . '</td>';

echo '</tr>';
}
echo '</table>';
echo '</body></html>';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Report Page</title>
<link rel="stylesheet" type="text/css" href = "../HTML/League_css.css">
</head>
<body>
</body>
</html>
