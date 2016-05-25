<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="keywords" content="HTML,XHTML,CSS"/>
		<meta name="description" content="A local food webpage"/>
		<meta name="author" content="Farinaz Jowkarishasaltaneh"/>
		<link rel="stylesheet" type="text/css" href="" />
		<script src="js/validate.js"></script>
	
		<title> Food Website </title>
	</head>

	<body id="loginform">
		<article class="mainContent">
			<!-- Header -->
			<header>
				<h1> Login Page </h1>
			</header>
			<!-- Header -->
			<div class="clearCss"></div>
			<!-- Menu -->
			<div id="menu">
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
			
			<form method="post" action="adminlogin.php">
			<fieldset><legend>Admin login page</legend>
				<p>	<label for="username">Username : </label>
					<input type="text" name="username" id="username" /></p>
					<span id="email_msg"></span>
				<p>	<label for="password">Password : </label>
					<input type="text" name="password" id="password" /></p>
				<p>	<input type="submit" value="login" /></p>
		
	</fieldset>
			</form>
			
			
			<?php
			session_start();
			if ((isset($_POST["username"])) && (isset($_POST["password"])) ) {
			$username = $_POST['username'];
			$password=$_POST['password'];

				if ($username!="" && $password!="") 
				{
					require_once('settings.php');
					$conn = @mysqli_connect($host, $user, $pass,$db);
					// Checks if connection is successful
					if (!$conn)
						{
							// Displays an error message
							echo "<p class=\"wrong\">Database connection failure</p>"; 
						} 
						else 
						{
							$admin="admin";
							$query="select * from $admin where username='$username' and password='$password'";
							$result =mysqli_query($conn, $query); 

							 if(mysqli_num_rows($result) == 0)
							 {
								echo "The username or password are not correct";
							 } 
							 else if(mysqli_num_rows($result)>0 )
							 {
								header('location: profile.php');

							 }
						}
				} else {
						echo "<p>please enter both username and password</p>";
						}
				}
			?>

	</body>
</html>