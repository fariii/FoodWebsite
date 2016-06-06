

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

	</body>
</html>
