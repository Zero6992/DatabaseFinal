<?php
session_start();
$conn = require('config.php');
// 是否為管理員
$admin = require('isAdmin.php');
$topMargin = '20rem';
if ($_SESSION['user_type'] == '管理員') {
	$topMargin = '27rem';
}

$user_id = $_SESSION['user_id'];
$sql =  sprintf(
	"SELECT * FROM `team10`.`user` WHERE `user_id`= %s",
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
			float: left;
			position: relative;
			padding: 1rem 2rem 0.5rem 2.5rem;
			border: 3px solid #776e62;
			transition: padding 0.3s ease-in-out;
		}

		.mainTitle::before {
			content: "";
			position: absolute;
			top: 0.5rem;
			left: 0.5rem;
			z-index: -1;
			height: 100%;
			width: 100%;
			background-color: #dddfca;
			border-right: 3px solid #dddfca;
			border-bottom: 3px solid #dddfca;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;

		}

		.mainTitle:hover {
			padding: 0.75rem 2.25rem;
		}

		.mainTitle:hover::before {
			top: 0;
			left: 0;
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
			text-decoration: none;
			border-color: #ffffff;
			color: #127a7a;
			cursor: pointer;
			background-image: linear-gradient(45deg, transparent 50%, #000000 50%);
			background-position: 25%;
			background-size: 400%;
			-webkit-transition: background 500ms ease-in-out, color 500ms ease-in-out;
		}

		a:hover {
			color: #ffffff;
			background-position: 100%;
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

		@media screen and (max-width:890px) {

			.topBar,
			.admin {
				display: inline-flex;
				flex-direction: column;
				border: unset;
			}


			.ReturnBar {
				top: 36rem;
				right: -1.4rem;
			}
		}

		@media screen and (max-width:630px) {

			.topBar,
			.admin {
				width: auto;
				float: right;
				margin-top: 1rem;
				display: unset;
				border-bottom: solid rgba(10, 25, 77, 0.3) 0.2rem;
			}


			.ReturnBar {
				margin-top: 40rem;
				width: 20rem;
			}
		}

		@media screen and (min-width:1440px) {
			.topBar {
				position: absolute;
				right: 0rem;
			}

			.admin {
				position: relative;
				top: 7.8rem;
			}
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
			<li><a href="./taskManage.php">管理案件</a></li>
			<li><a href="./userManage.php">管理使用者</a></li>
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
	</p>



</body>

</html>