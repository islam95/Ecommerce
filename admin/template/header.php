<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Khizir - Admin Panel</title>
	<meta name="Author" content="Islam Dudaev" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="../css/main.css" rel="stylesheet" type="text/css">
	<link href="../css/buttons.css" rel="stylesheet" type="text/css">
	<link href="../css/admin.css" rel="stylesheet" type="text/css">
</head>
	
<body>
	<div id="mainWrapper">
		<header>
			<!-- This contains Logo and links -->
			<div id="logo">
				<a href="?page=products">
					<img src="../images/logo.gif" alt="Khizir Store" />
				</a>
			</div>

			<!-- Title of the Admin Panel -->
			<div id="a_title">
				<h2>Admin Panel</h2>
			</div>

			<div id="headerLinks">
				<?php
					// if user logged in
					if(Login::loggedIn(Login::$admin_login)){
						echo '<div id="logged_as">Hi <strong>';
						echo Login::getUserName(Session::getSession(Login::$admin_login));
						echo '</strong> | <a href="?page=logout">Logout</a></div>';
					} else{
						echo '<div id="logged_as"><a href="?page=index">Login</a></div>';
					}
					?>
			</div>
		</header>
