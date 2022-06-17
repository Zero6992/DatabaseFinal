<?php
session_start();

// 是否登出
if (!isset($_SESSION["loggedin"])) {
	function_notLogIn("您已登出!請重新登入!");
}
// 是否為管理員
$admin = 'none';
if ($_SESSION['user_type'] == 2) {
	$admin = 'initial';
}
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
			display: <?= $admin ?>;
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
			padding: 2rem;
			margin: auto;
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


		.button {

			width: 8rem;
			font-size: 2.2rem;
			background-color: #07000E;
			color: aliceblue;
			border-radius: 7%;
			box-shadow: 4px 3px 4px rgb(63, 134, 192);
			font-weight: bold;

		}

		.button:hover {
			color: #e76f45;
			background-color: aliceblue;
			box-shadow: 4px 3px 4px rgb(139, 28, 28);
			transition: 1s;
			cursor: pointer;
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
			<li><a href="./contact.php">聯絡我們</a></li>
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
	<form class="ReturnBar" action="return.php" method="post">

		<div class="canva">
			<h1 class="bigTitle">聯絡資訊</h1>

			<p>聯絡信箱</p>
			<p>ga@ntnu.edu.tw</p>
			<p> </p>

			<p>聯絡電話</p>
			<p>(02)7749-1924</p>
			<p> </p>


			<p>辦公室位址</p>
			<p>106台北市和平東路一段162號(國立臺灣師範大學-總務處)</p>
		</div>

	</form>

	</p>


</body>

</html>