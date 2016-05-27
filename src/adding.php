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

	<body id="profileForm">
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

		<section>
			<form method="post" action="profile.php">
			<p>You can update the menu by filling the following: </p>
				<p>
					<label>Meal Name:
					<input type="text" name="FoodName" id="FoodName" />
					</label>
				</p>

				<p>
					<label>New price:
					<input type="number" name="price" id="price" />
					</label>
					<span id="price_msg"></span>
				</p>

				<p>
					<label>New description:
					<input type="text" name="description" id="description" />
					</label>
				</p>

				<input type="submit" name="updating" value="update" />
					<input type="submit" name="adding" value="add"/>
				
					
			</form>
		</section>

	<?php 
		
			require_once('settings.php');
			$conn = @mysqli_connect($host, $user, $pass,$db);
		//	require_once('table.php');
			
			if ((isset($_POST["adding"])))
			{
				$FoodName = trim($_POST["FoodName"]);
				$price = trim($_POST["price"]);
				$description = trim($_POST["description"]);
				if ($FoodName && $price && $description) 
				{
					$insert = "insert into menu (FoodName,price,description) 
					values ('$FoodName','$price','$description')"; 
					$insert_result = mysqli_query($conn, $insert); 
					
					if(!$insert_result)
					{ 
						echo "This meal already exists"; 
					}
					else
					{ 
						echo "<p class=\"ok\">'$FoodName' is added to the menu.</p>"; 
						header("location: profile.php");
					} 
				}
				else
				{
					echo "Please enter all the requirement.";
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
</html>
