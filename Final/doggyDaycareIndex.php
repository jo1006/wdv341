<?php
session_start();
if (!(isset($_SESSION['validUser']))) {
	$_SESSION['validUser'] = "";
}	

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Doggy Daycare</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/daycarestyle.css" type="text/css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<style  type="text/css">
		
	</style>
	<script>
	
	</script>
  </head>
<body>
  	<header>
	<p><img src="images/pawprint.png" alt="paw" />
	<span id="title">Doggy Daycare
<?php 
	if ($_SESSION['validUser'] == "yes") {
		echo ' - Admin';
	}
?>
	</span></p>
	</header>
<?php 
	echo '<div style="margin-left:93%">';
	if (!($_SESSION['validUser'] == "yes")) {
		echo '<a style="padding:4px" href="login.php">Login</a>';
	} else {
		echo '<a style="padding:4px" href="logout.php">Logout</a>';
	}
?>
		<a href="email.php">Email</a>
	</div>
	<div class="navbarN">
		<a href="">Home</a>
		<div class="dropdownM">
			<button class="dropbtnM">Check In/Out
			<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdownM-content">
				<a href="">Check In</a>
				<a href="">Check Out</a>
			</div>
		</div>
		
<?php
	if ($_SESSION['validUser'] == "yes") {
			echo '<div class="dropdownM" >';
			echo '<button class="dropbtnM">Dogs';
			echo '<i class="fa fa-caret-down"></i>';
			echo '</button>';
			echo '<div class="dropdownM-content">'; 
			echo '<a href="addDog.php">Add</a>';
			echo '<a href="updateDog.php">Update</a>';
			echo '<a href="deleteDog.php">Delete</a>';
			echo '</div>';
			echo '</div>';
	} else {
			echo '<a href="">Dogs</a>';
	}
?>
		<div class="dropdownM">
			<button class="dropbtnM">Owners 
			<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdownM-content">
				<a href="addOwner.php">Add</a>
				<a href="updateOwner.php">Update</a>
			</div>
		</div> 
		<div class="dropdownM">
			<button class="dropbtnM">Incidents 
			<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdownM-content">
				<a href="">Add</a>
				<a href="">Update</a>
			</div>
		</div> 
		<div class="dropdownM">
			<button class="dropbtnM">Classes 
			<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdownM-content">
				<a href="">Basic Manners</a>
				<a href="">Advanced Manners 2</a>
				<a href="">Agility Training</a>
				<a href="">Private Training</a>
			</div>
		</div> 
		<div class="dropdownM">
			<button class="dropbtnM">Reports 
			<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdownM-content">
				<a href="">Today's Playground</a>
				<a href="">Aggression</a>
				<a href="">Current Facility Count</a>
				<a href="">All Dogs</a>
				<a href="">All Owners</a>
			</div>
		</div> 
	</div>
	
	<p><img id="centerImg" src="images/playground.jpg" alt="dogs" />
	<img id="centerImg" src="images/bulldog.jpg" alt="dogs" />
	<img id="centerImg" src="images/tug.jpg" alt="dogs" /></p>

  </body>
 </html>