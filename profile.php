<?php
session_start();
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

$user_id = $_SESSION['user_id'];

$sql =  sprintf(
	"SELECT * FROM `project`.`user` WHERE `user_id`= %s",
	$user_id
);

$result = mysqli_query($conn, $sql);
$read = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>

<head>
	<title>HomePage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<style>
		body {
			background-color: #bbbf95;
		}

		.mainTitle {
			cursor: pointer;
			color: #127a7a;
			font-size: 2.8rem;
			padding: 0.2rem;
			float: left;
			margin-left: 2%;
			margin-top: 1.5rem;

		}

		.returnForm {
			display: flex;
			margin-bottom: 30rem;
			justify-content: center;
			align-items: center;
		}

		.topBar {

			width: auto;
			float: right;
			margin-top: 1rem;
			border-bottom: solid rgba(10, 25, 77, 0.3) 0.2rem;
		}

		.admin {
			/* visibility: hidden; */
			/*看使用者權限*/
			width: auto;
			float: right;
			margin-top: 1rem;
			border-bottom: solid rgba(10, 25, 77, 0.3) 0.2rem;
		}

		.admin a {
			color: #720017;
		}

		li {
			font-size: 1.5rem;
			font-weight: bold;
			display: inline-block;
			padding: 1.6rem 2rem;
		}

		a {
			text-align: center;
			color: black;
			text-decoration: none;

		}

		a:hover {

			color: #B9e5f3;
			background-color: black;
			background-size: 50% 30%;
			transition: 1s;
			border: solid rgba(10, 25, 77, 1) 0.2rem;
		}

		.bigTitle {
			cursor: default;
			font-size: 3rem;
			text-shadow: black 1rem 0.1em 0.2em;
			display: flex;
			justify-content: center;
		}

		.ReturnBar {
			background-color: #23345c;
			border-radius: 2rem;
			box-shadow: 14px 20px 30px #04010c;
			color: aliceblue;
			width: 40rem;
			margin: auto;
			margin-top: 30rem;
			padding: 2rem;

		}

		.ReturnBar p {
			cursor: default;
			display: flex;
			font-size: 1.4rem;
			font-weight: bolder;

		}

		.inputText {
			font-size: 1.5rem;
			font-weight: bolder;
			width: 32rem;
			height: 2.5rem;
			margin-left: 0.rem;
			border-radius: 20px;
			text-align: center;

		}

		.describe {
			font-size: 1.5rem;
			font-weight: bolder;
			width: 32rem;
			height: 6rem;
			margin-left: 0.rem;
			border-radius: 20px;
			text-align: center;

		}

		.inputText:focus {
			background-color: azure;
			transition: 1s;
			outline: none
		}

		.ProfileTitle {
			color: #f2a830;
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
		}
	</style>
</head>

<body>

	<a href="./homepage.php">
		<h1 class="mainTitle">師大環境通報系統</h1>
	</a>
	<nav>
		<ul class="topBar">
			<li><a href="./task.php">案件查詢</a></li>
			<li><a href="./track.php">回報案件追蹤</a></li>
			<li><a href="./contact.html">聯絡我們</a></li>
			<li><a href="./profile.php">個人資料</a></li>
			<li><a href="./logout.php">登出</a></li>
		</ul>
		<ul class="admin">
			<li><a href="#">管理案件</a></li>
			<li><a href="#">管理使用者</a></li>
			<li><a href="#">管理公司</a></li>
		</ul>
	</nav>


	<p class="returnForm">
	<div class="ReturnBar">

		<h1 class="bigTitle">個人資料</h1>

		<p>名稱</p>
		<p class="ProfileTitle"><?php print $read['name'] ?></p>
		<p> </p>

		<p>信箱</p>
		<p class="ProfileTitle"><?php print $read['mail'] ?></p>
		<p> </p>

		<p>帳號</p>
		<p class="ProfileTitle"><?php print $read['account'] ?></p>
		<p></p>



	</div>




</body>

</html>