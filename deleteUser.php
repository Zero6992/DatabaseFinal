<?php
session_start();
include 'notLogIn.php';
// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "wendy1102";
$dbname = "team10";

/*
$servername = "localhost";
$username = "team10";
$password = "Ce8l68";
$dbname = "team10";
*/

// Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
	printf("Error loading character set utf8: %s\n", $conn->error);
	exit();
}

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = sprintf(
	"DELETE from task WHERE task_id = %d",
	$id
);

$result = $conn->query($sql);
if (!$result) {
	function_alert('刪除失敗!!');
} else {
	function_alert('刪除成功!!');
}

function function_alert($message)
{
	// Display the alert box  
	echo "<script>
	 alert('$message');
     window.location.href='taskManage.php';
    </script>";
	return false;
}



?>
