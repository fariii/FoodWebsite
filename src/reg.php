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

	<body id="regform">
		<article class="mainContent">
			<!-- Header -->
			<header>
				<h1> Registration Page </h1>
			</header>
			<!-- Header -->
			<div class="clearCss"></div>
			<!-- Menu -->
			<div id="menu">
				<nav>
					<ul>
						<li><a id="Link1" class="Link" href="login.php">Login Page</a></li>
						<li><a id="Link1" class="Link" href="reg.php">Registration Page</a></li>
						<li><a id="Link2" class="Link" href="menu.php">Order food</a></li>
						<li><a id="Link1" class="Link" href="logout.php">Logout</a></li>
						<li><a id="Link2" class="Link" href="profile.php">Administration</a></li>
					</ul>
				</nav>
				<!-- Menu -->
			</div>
			
			<div class="clearCss"></div>
			<hr/>
			<div class="clearCss"></div>
			<article class="Content">


	<section>
		<form id="form" method="post" action="reg.php">
		<p> <label> Email
		<input type="text" name="email" id="email"/> 
		</label>
		<span id="email_msg"></span>
		</p>

		<p> <label> Password
		<input type="text" name="password" id="password"/>
		</label>
		</p>

		<p> <label> Name
		<input type="text" name="name" id="name"/>
		</label>
		<span id="name_msg"></span>
		</p>

		<p> <label> Mobile Number
		<input type="text" name="phone" id="phone" placeholder="(##) ####-####"
		pattern="\(\d\d\) \d\d\d\d-\d\d\d\d"/>
		</label>
		<span id="phone_msg"></span>
		</p>
		<input id="submit" type="submit" value="Register"/>
		<input type="reset" value="Reset" />
	</p>
	</form>
</section>
</article>

<?php
		if ((isset($_POST["email"])) && (isset($_POST["password"])) &&  (isset($_POST["name"])) 
			&&  (isset($_POST["phone"])))
			{
					$email = trim($_POST["email"]);
					$password = trim($_POST["password"]);
					$name = trim($_POST["name"]);
					$phone = trim($_POST["phone"]);
					$result="";
					

				if ($email && $password && $name && $phone) 
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
						$sql_table="registration";
						$insert = "insert into registration (email,password,name,phone) 
						values ('$email','$password','$name','$phone')"; 
						// execute the query -we should really check to see if the database exists first. 
						$insert_result = mysqli_query($conn, $insert); 
						// checks if the execution was successful 
						if(!$insert_result)
						{ 
							$result= "This email already exists"; 
						}
						else
						{ 
							// display an operation successful message 
							echo "<p class=\"ok\">Congrats! You've sigend up successfully</p>"; 
						} // if successful query operation
										 
									
					}
					echo $result;
				}
				else
				{
			 		echo "Please enter all the details";
			 	}

						
			}
			

		?>
	<div class="clearCss"></div>	
			<hr/>
			<div class="clearCss"></div>	
			<!-- Footer -->
			<footer> 
			</footer>
			<!-- Footer -->
		</article>	

	</body>
</html>