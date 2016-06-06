<?php 
		
			require_once('settings.php');
			$conn = @mysqli_connect($host, $user, $pass,$db);
			require_once('table.php');
			
			if ((isset($_POST["updating"])))
			{
				$FoodName = trim($_POST["FoodName"]);
				$price = trim($_POST["price"]);
				$description = trim($_POST["description"]);
				$result="";

				if ($FoodName && $price && $description) 
				{

					$query2 = "UPDATE menu SET price=$price WHERE FoodName='$FoodName'";
					$query3 = "UPDATE menu SET description='$description' WHERE FoodName='$FoodName'";
					$result2 = mysqli_query($conn,$query2);
					$result3= mysqli_query($conn,$query3);
					// checks if the execution was successful 
					if ($result2 && $result3)
					{ 
						header("location: profile.php");
						
					}

					else
					{
						echo "Meal doesnt exist";
					}
					
				} // are entered
				else
				{
					echo "Please enter all the requirement.";
				}
			
			} // end of isset





			if ((isset($_POST["adding"])))
			{

				$FoodName = trim($_POST["FoodName"]);
				$price = trim($_POST["price"]);
				$description = trim($_POST["description"]);

				if ($FoodName && $price && $description) 
				{
						$insert = "insert into menu (FoodName,price,description) 
						values ('$FoodName','$price','$description')"; 
						// execute the query -we should really check to see if the database exists first. 
						$insert_result = mysqli_query($conn, $insert); 
						// checks if the execution was successful 
						if(!$insert_result)
						{ 
							echo "This meal already exists"; 
						}
						else
						{ 
							// display an operation successful message 
							echo "<p class=\"ok\">'$FoodName' is added to the menu.</p>"; 
							header("location: profile.php");

						} // if successful query operation


					
				} //end of if are entered
				else
				{
					echo "Please enter all the requirement.";
				}
			}





	 ?>
