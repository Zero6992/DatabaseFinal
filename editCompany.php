<?php
session_start();
$conn=require('config.php');

$id = $_GET['id'];
$phone = $_POST['phone'];
$bank_account = $_POST['bank_account'];
$mail = $_POST['mail'];


// 更新SQL
$sql = sprintf(
	"UPDATE company SET mail = '%s', phone = '%s', bank_account = '%s' WHERE company_id = %d",
	$mail,
	$phone,
	$bank_account,
	$id
);

$result = $conn->query($sql);
if (!$result) {
	function_alert('更新失敗!!');
} else {
	 function_alert('更新成功!!');
}

function function_alert($message)
{
	// Display the alert box  
	echo "<script>
	 alert('$message');
     window.location.href='companyManage.php';
    </script>";
	return false;
}
