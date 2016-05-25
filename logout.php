
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="keywords" content="HTML,XHTML,CSS"/>
		<meta name="description" content="Food website"/>
		<meta name="author" content="Farinaz Jowkarishasaltaneh"/>
		<link rel="stylesheet" type="text/css" href=""/>
		<title> Food website </title>
	</head>
	<body id="booking">
		<article class="mainContent">
			<!-- Header -->
			<header>
				<h1>Log out</h1>
			</header>
			<!-- Header -->
			<div class="clearCss"></div>
			<!-- Menu -->
			<div id="login">
				<nav>
					<ul>
						<li><a id="Link1" class="Link" href="reg.php">Registration Page</a></li>
						<li><a id="Link1" class="Link" href="login.php">Login</a></li>
						<li><a id="Link1" class="Link" href="logout.php">Logout</a></li>
						<li><a id="Link2" class="Link" href="adminlogin.php">Restaurant owner</a></li>
				
					</ul>
				</nav>
				<!-- Menu -->
			</div>
			<div class="clearCss"></div>
			<hr/>
			<div class="clearCss"></div>
			<article class="Content">
			<?php
				session_start();
				session_destroy();
				echo"You have been logged out";
			?>
</html>