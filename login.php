<?php
			session_start();
			if ((isset($_POST["email"])) && (isset($_POST["password"])) ) {
			$email = $_POST['email'];
			$password=$_POST['password'];

				if ($email!="" && $password!="") 
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
							$query="select * from $sql_table where email='$email' and password='$password'";
							$result =mysqli_query($conn, $query); 

							 if(mysqli_num_rows($result) == 0)
							 {
								echo "The email or password are not correct";
							 } 
							 else if(mysqli_num_rows($result)>0 )
							 { ///here
							 		header('location: menu.php');
								
							 }//here
						}
				} else {
						echo "<p>please enter both email and password</p>";
						}
				}
?>
