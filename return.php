<?php

// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "wendy1102";
$dbname = "project";

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

if (isset($_POST['task_type']) && isset($_POST['location']) && isset($_POST['time']) && isset($_POST['problem']) ) {
	$task_type = $_POST['task_type'];
	$location = $_POST['location'];
	$time = $_POST['time'];
	$problem = $_POST['problem'];

	$insert_sql = "INSERT INTO TASK (task_type,location,time,problem) VALUES('$task_type','$location','$time','$problem');";	// ******** update your personal settings ******** 
	
	if ($conn->query($insert_sql) === TRUE) {
		echo "回報成功!!<br> <a href='return.html'>返回主頁</a>";
	} else {
		echo "<h2 align='center'><font color='antiquewith'>回報失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
// 123
?>

