<?php
session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add Owner</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/daycarestyle.css" type="text/css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<style  type="text/css">
	.container {
		width: 80%;
		background-color: yellow;
		border-radius: 25px;
		margin-top: 20pt;
	}	
	</style>
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
		<a href="doggyDaycareIndex.php">Home</a>
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
				<a href="">Update</a>
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
	
	
<?php 
	if ($_SESSION['validUser'] == "yes") {
		echo '<div class="container" style="background-color:#00FF00;">';
	} else {
		echo '<div class="container">';	
	}
?>
		<form action="updateOwnerServlet" method="post">
			<h2 align="center">Update Owner</h2>
			</br>
			<div class="form-group row"> 
				<label for="firstName" class="col-sm-2 col-form-label text-right">First Name</label>
				<div class="col-sm-3">
					<input id="firstName" type="text" class="form-control" placeholder="Enter First Name">
				</div>
				<label for="lastName" class="col-sm-3 col-form-label text-right">Last Name</label>
				<div class="col-sm-3">
					<input id="lastName" type="text" class="form-control" placeholder="Enter Last Name">
				</div>
			</div>
			<div class="form-group row"> 
				<label for="street" class="col-sm-2 col-form-label text-right">Street</label>
				<div class="col-sm-4">
					<input id="street" type="text" class="form-control" placeholder="Enter Street">
				</div>
			</div>
			<div class="form-group row">
				<label for="city" class="col-sm-2 col-form-label text-right">City</label>
				<div class="col-sm-2">
					<input id="city" type="text" class="form-control" placeholder="Enter City">
				</div>
				<label for="state" class="col-sm-1 col-form-label text-right">State</label>
				<div class="col-sm-2">
					<select id="state" class="form-control">
						<option value="IL">Illinois</option>
						<option value="IA" selected>Iowa</option>
						<option value="KS">Kansas</option>
						<option value="MN">Minnesota</option>
						<option value="NE">Nebraska</option>
					</select>
				</div>
				<label for="zip" class="col-sm-1 col-form-label text-right">Zip</label>
				<div class="col-sm-2">
					<input id="zip" type="text" class="form-control" placeholder="Enter Zip">
				</div>
			</div>
		</br>
		</form>
  </body>
 </html>