<?php

require_once "bootstrap.php";

//redirect to login.php when no user is logged in
if (!isset($_SESSION["user"])) {
	header("Location: login.php"); 
}

$food_data = array(	"adding" => "",
					"FoodName" => "",
					"price" => "",
					"description" => "");

$page_messages = array(	"existing_meal" => false,
						"missing_data" => false,
						"error_add_meal" => false,
						"meal_added" => false,
						"meal_updated" => false,
						"error_update_meal" => false);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//check input data
	$missing_data = false;

	foreach($food_data as $reg_key => $reg_value) {
		
		if (!isset($_POST[$reg_key])) {
			$missing_data = true;
			break;
		}
		
		if (!is_string($_POST[$reg_key])) {
			$missing_data = true;
			break;		
		}
		
		$value = trim($_POST[$reg_key]);
		
		if (!$value) {
			$missing_data = true;
			break;
		}
		
		$food_data[$reg_key] = $value;
	}

	if ($missing_data) {
		$page_messages["missing_data"] = true;
	}
	else {
		
		$existing = db::Instance()->Query("SELECT * FROM `menu` WHERE `FoodName` = ?",
										  array(\PDO::PARAM_STR),
										  array($food_data["FoodName"]));
		
		if (!$existing) {
			
			$result = db::Instance()->Query("INSERT INTO `menu` (`FoodName`,`price`,`description`)" .
											" VALUES (?,?,?)",
											array(\PDO::PARAM_STR, \PDO::PARAM_STR, \PDO::PARAM_STR),
											array($food_data["FoodName"], $food_data["price"], $food_data["description"]));
			
			if (!$result) {
				$page_messages["error_add_meal"] = true;
			}
			else {
				$page_messages["meal_added"] = true;
			}
		}
		else if ($food_data["adding"] == "update") {
			
			$result = db::Instance()->Query("UPDATE `menu` SET `price` = ?, `description` = ? WHERE `FoodName` = ?",
											array(\PDO::PARAM_STR, \PDO::PARAM_STR, \PDO::PARAM_STR),
											array($food_data["price"], $food_data["description"], $food_data["FoodName"]));
			if ($result) {
				$page_messages["meal_updated"] = true;
			}
			else {
				$page_messages["error_update_meal"] = true;
			}
		}
		else {
			$page_messages["existing_meal"] = true;
		}
	}
}
?>
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
			<form method="post" action="adding.php">
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

				<input type="submit" name="adding" value="update" />
				<input type="submit" name="adding" value="add"/>
				
					
			</form>
		</section>
		<?php if ($page_messages["existing_meal"]) { ?>
			This meal already exists
		<?php } else if ($page_messages["missing_data"]) { ?>
			Please enter all the requirement.
		<?php } else if ($page_messages["error_add_meal"]) { ?>
			Failed insert new meal
		<?php } else if ($page_messages["meal_added"]) { ?>
			New meal added
		<?php } else if ($page_messages["meal_updated"]) { ?>
			meal updated
		<?php } else if ($page_messages["error_update_meal"]) { ?>
			meal update failed
		<?php } ?>
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