<?php  
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

?>