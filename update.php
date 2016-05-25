<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="keywords" content="HTML,XHTML,CSS"/>
		<meta name="description" content="A local food webpage"/>
		<meta name="author" content="Farinaz Jowkarishasaltaneh"/>
		<link rel="stylesheet" type="text/css" href="" />
		<script src="js/validate.js"></script>
	
		<title> Food website </title>
	</head>

	<body id="profileform">
		<article class="mainContent">
			<!-- Header -->
			<header>
				<h1> Administration page </h1>
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

<?php  
		session_start();
		if(isset($_POST["submit1"]) &&  isset($_POST["FoodName"]) &&  isset($_POST["price"])
			&& isset($_POST["description"]))
		{

			$FoodName=$_POST["FoodName"];
			$price = trim($_POST["price"]);
			$description = trim($_POST["description"]);
			$result="";


			echo $FoodName;
			echo $price;
			echo $description;

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

				$result="";
				
					$inserting = "UPDATE menu SET price='$price', description='$description' where FoodName='$FoodName'"; 
					$inserting_result = mysqli_query($conn, $inserting);
					
					$result= "Updated successfully"; 
					echo $result;

			}
		
		}
?>

</article>

	<div class="clearCss"></div>	
			<hr/>
			<div class="clearCss"></div>	
			<!-- Footer -->
			<footer> 
			</footer>
			<!-- Footer -->
		</article>	

	</body>