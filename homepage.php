<?php
session_start();

$conn=require('config.php');
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
			box-shadow: -10px 10px 0px 0px black;
			color: aliceblue;
			width: 45rem;
			padding: 2rem;
			margin: auto;
			margin-top: <?= $topMargin ?>;

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
			<li><a href="./taskManage.php">管理案件</a></li>
			<li><a href="./userManage.php">管理使用者</a></li>
			<li><a href="#">管理公司</a></li>
		</ul>
	</nav>

	<p class="returnForm">
	<form class="ReturnBar" action="./return.php" method="post">
		<h1 class="bigTitle">環境通報表單</h1>

		<p>問題類別</p>
		<select class="inputText" name="task_type">
			<option disabled>請選擇一個問題類別</option>
			<option value="廢棄物" selected>廢棄物</option>
			<option value="落葉">落葉</option>
			<option value="髒污清潔">髒污清潔</option>
			<option value="器物損壞">器物損壞</option>
			<option value="其他">其他</option>
		</select>

		<p>發現時間</p>
		<input class="inputText" type="datetime-local" name="time" />

		<p>地點</p>
		<input class="inputText" type="text" name="location" placeholder="填寫問題發生地點" />

		<p>簡述環境問題</p>
		<textarea class="describe" name="problem" placeholder="請簡述問題，30字以內"></textarea>
		<p style="float: right">
			<input class="button" type="submit" value="回報" />
		</p>
		</p>
	</form>




</body>

</html>