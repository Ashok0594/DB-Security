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

$username = "User";
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


$query ="SELECT
emp_no,
birth_date,
first_Name,
last_Name,
gender,
hire_date
FROM employees
order by 1
limit 50;";

$data = mysqli_query($conn,$query);
$Color = "#ff6600";



echo '<div id ="head"><h1>User Reports</h1><hr></div>';
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
echo '<p class="tab">Logged in with <b>User Privileges</b></p>';
echo '<p class="tab">Your Last Login Time was <b style="Color:'.$Color.'">'.$loginnTime .'</b></p>';
echo '<p class="tab">Your Last Logout Time was <b style="Color:'.$Color.'">'.$logooutTime .'</b></p>';

echo '<div style="text-align:center">'.'<form name="q" method="post" action="../Database/Check.php" >'.
'<p class="center" >Query</p>'.
'<input type="text" name="query" id="query" style="width:1000px; height:50px;" required="required"/><br><br>'.

'<button type="submit" name="Enter" id="Enter" value="Enter"'.
' style="border-radius: 10px;background-color: #ff6600;border: none;font-size: 16px;color:#001a33;padding: 10px 100px;" />Execute</button>'.
'</form>'.'</div>';


echo '<p class="center" >Employees Table</p>';

echo  '<table>';
echo '<tr>';
echo '<th>Employee ID</th>';
echo '<th>Birth Date</th>';
echo '<th>First Name</th>';
echo '<th>Last Name</th>';
echo '<th>Gender</th>';
echo '<th>Hire Date</th>';

echo '</tr>';
while($row = mysqli_fetch_array($data))
{
echo '<tr>';
echo '<td>' . $row['emp_no'] . '</td>';
echo '<td>' . $row['birth_date'] . '</td>';
echo '<td>' . $row['first_Name'] . '</td>';
echo '<td>' . $row['last_Name'] . '</td>';
echo '<td>' . $row['gender'] . '</td>';
echo '<td>' . $row['hire_date'] . '</td>';
echo '</tr>';
}
echo '</table>';
echo '</body></html>';


$query ="SELECT
count(*) as total
FROM employees
order by 1
limit 50;";

$data = mysqli_query($conn,$query);
$Color = "#cc0000";
$t = 0;

while($row = mysqli_fetch_array($data))
{
$t=$row['total']-50;
if ($t>0){
  echo '<p class="more" >'.$t.' More records available in database...</p>';
  echo '</br></br>';
}


}

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
