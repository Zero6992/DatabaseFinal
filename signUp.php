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
if (isset($_POST['userName']) && isset($_POST['userMail']) && isset($_POST['userAccount']) && isset($_POST['userPassword'])) {
	$userName = $_POST['userName'];
	$userMail = $_POST['userMail'];
	$userAccount = $_POST['userAccount'];
	$userPassword = $_POST['userPassword'];

	$insert_sql = "INSERT INTO USER (user_type,NAME,mail,ACCOUNT,PASSWORD) VALUES(1,'$userName','$userMail','$userAccount','$userPassword');";	// ******** update your personal settings ******** 
	
	if ($conn->query($insert_sql) === TRUE) {
		echo "新增成功!!<br> <a href='./signIn.html'>返回主頁</a>";
	} else {
		echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>

