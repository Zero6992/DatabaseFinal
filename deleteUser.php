<?php
session_start();
$conn=require('config.php');

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
