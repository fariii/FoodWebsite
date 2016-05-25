<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="keywords" content="HTML,XHTML,CSS"/>
		<meta name="description" content="A local food webpage"/>
		<meta name="author" content="Farinaz Jowkarishasaltaneh"/>
		<link rel="stylesheet" type="text/css" href="indexstye.css" />
		<script src="js/validate.js"></script>
	
		<title> Food website </title>
	</head>

	<body id="menuform">
		<article class="mainContent">
			<!-- Header -->
			<header>
				<h1> Ordering food </h1>
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

			<form method="post" action="menu.php">
				<p>
					<label>Select your meal:
					<input type="text" name="name" id="name" />
					</label>
				</p>
				<p>	<input type="submit" value="order" /></p>
			</form>

		<?php 
		
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
						$query = "SELECT * FROM menu ";
						$result = mysqli_query($conn,$query) ;
						if(mysqli_num_rows($result)>0)
						{
						// Display the retrieved records
								
							echo "<table border=\"1\">"; 
							echo "<tr>" 
							."<th scope=\"col\">Food Name</th>" 
							."<th scope=\"col\">Price</th>" 
							."<th scope=\"col\">Description</th>" 
							."</tr>";

							while ($row = mysqli_fetch_assoc($result))
							{ 
								echo "<tr>"; 
								echo "<td>",$row["FoodName"],"</td>"; 
								echo "<td>",$row["price"],"</td>"; 
								echo "<td>",$row["description"],"</td>"; 
								echo "</tr>"; 
							}
							 echo "</table>";
							// Frees up the memory, after using the result pointer
							mysqli_free_result($result);

						}

						if ( ((isset($_POST["name"]))) )
						{
							$name = $_POST['name'];
							if ($name!="")
							{
								$query1 = "SELECT * FROM menu where FoodName='$name'";
								$result1 = mysqli_query($conn,$query1) ;
								if(mysqli_num_rows($result1)>0)
								{
									echo "Thanks for your purchase. Your order has been successfully made and ready to pick up in 15 minutes";
								}
								else
								
									echo "Item does not exist, please try again";
							}

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