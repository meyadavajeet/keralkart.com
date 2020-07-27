<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>KeralKart</title>
	<style>
		body {
			/*background: url("*/
		<?//=base_url()?> /*assets/home/images/keralkartbackground.png");*/
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			background: #f2f2f2;
			/*background: #34495e;*/

		}

		.box {
			width: 300px;
			padding: 40px;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			/*background: #191919;*/
			/*background: #88e8d1;*/
			background: white;
			text-align: center;
			box-shadow: 4px 4px 8px 4px rgba(0, 0, 0, 0.5);
			transition: 0.3s;
		}

		.box h1 {
			color: green;
			text-transform: uppercase;
			font-weight: 500;
		}

		.box input[type = "text"], .box input[type = "password"] {
			border: 0;
			background: none;
			display: block;
			margin: 20px auto;
			text-align: center;
			border: 2px solid #3498db;
			padding: 14px 10px;
			width: 200px;
			outline: none;
			color: green;
			border-radius: 24px;
			transition: 0.25s;
		}

		.box input[type = "text"]:focus, .box input[type = "password"]:focus {
			width: 280px;
			border-color: #2ecc71;
		}

		.box input[type = "submit"] {
			border: 0;
			background: none;
			background: blue;
			display: block;
			margin: 20px auto;
			text-align: center;
			border: 2px solid #2ecc71;
			padding: 14px 40px;
			outline: none;
			color: white;
			border-radius: 24px;
			transition: 0.25s;
			cursor: pointer;
		}

		.box input[type = "submit"]:hover {
			/*background: #2ecc71;*/

			background: #2ecc71;
		}
	</style>
</head>
<body>

<form class="box" action="<?php echo base_url() ?>Login/adminlogin" method="post" autocomplete="off">
	<img src="<?= base_url() ?>assets/home/images/logo.png" style="height: 80%; width: 80%; "/>
	<!--            <h1>Login</h1>-->
	<br>
	<b style="color: red"><?= $this->session->flashdata('wrong_pass'); ?></b>
	<input type="text" name="username" placeholder="Username" required="">
	<input type="password" name="password" placeholder="Password" required="">
	<input type="submit" name="submit" value="Login">
</form>
<?= validation_errors(); ?>
</body>
</html>
