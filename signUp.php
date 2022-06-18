<?php

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
if (empty($_POST['userName']) || empty($_POST['userMail']) || empty($_POST['userAccount']) || empty($_POST['userPassword'])) {
	function_alert("資料不完全!請重新註冊!!");
}else{
	$userName = $_POST['userName'];
	$userMail = $_POST['userMail'];
	$userAccount = $_POST['userAccount'];
	$userPassword = $_POST['userPassword'];

	$insert_sql = "INSERT INTO user(user_type,NAME,mail,ACCOUNT,PASSWORD) VALUES(1,'$userName','$userMail','$userAccount','$userPassword');";	// ******** update your personal settings ******** 
	
	if ($conn->query($insert_sql) === TRUE) {
		function_sucess("註冊成功!!");
	} else {
		function_alert("該帳號或信箱已有人使用!");
	}

}
mysqli_close($conn);

function function_sucess($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    
    return false;
}
function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='register.php';
    </script>"; 
    
    return false;
}
				
?>

