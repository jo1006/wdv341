<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Add Dog</title>  
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
			echo '<a href="">Add</a>';
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
<?php 
	if ($_SESSION['validUser'] == "yes") {
		echo '<div class="container" style="background-color:#00FF00;">';
	} else {
		echo '<div class="container">';	
	}
?>	
  		<form id="addDogForm" action="insertDog.php" method="post"> 
			<h2 align="center">Add Dog</h2>
			<br>
			<div class="form-group row">
				<div class="error-box hidden col-sm-6 col-sm-offset-3 text-center"></div>
			</div>
			<div class="form-group row"> 
				<label for="dogName" class="col-sm-3 col-form-label text-right">Name</label>
				<div class="col-sm-3">
					<input id="dogName" name="dogName" type="text" class="form-control" placeholder="Enter the name of dog">
				</div>
				<label for="age" class="col-sm-1 col-form-label text-right">Age</label>
				<div class="col-sm-1">
					<input id="age" name="age" type="text" class="form-control" placeholder="Enter age" >
				</div>
			</div>
			<div class="form-group row"> 
				<label for="breed" class="col-sm-3 col-form-label text-right">Breed</label>
				<div class="col-sm-3">
					<input id="breed" name="breed" type="text" class="form-control" placeholder="Enter Breed">
				</div>
				<label for="gender" class="col-sm-1 col-form-label text-right">Gender</label>
				<div class="col-sm-2">
					<select id="gender" name="gender" class="form-control">
						<option value="M" selected>Male</option>
						<option value="F">Female</option>
					</select>
				</div>
				
			</div>
			<div class="form-group row"> 
				<label for="owner" class="col-sm-3 col-form-label text-right">Owner</label>
				<div class="col-sm-4">
				  <input id="owner" name="owner" type="text" class="form-control" placeholder="Enter Owner">
				</div>
			</div>
			<div class="form-group row">
				<label for="vaccinated" class="col-sm-3 col-form-label text-right">Vaccinated</label>
				<div class="col-sm-2">
					<select id="vaccinated" name="vaccinated" class="form-control">
						<option value="Y" selected>Yes</option>
						<option value="N">No</option>
					</select>
				</div>
			</div>
			<input type="hidden" name="fromJsp" value="/addDog.jsp">
			<div class="form-group row">
				<button id="submitBtn" class="col-sm-2 col-sm-offset-5" type="button">Submit</button>
			</div>
			<br>
		</form>
	  </div>
  </body>
  <script type="text/javascript">
$("document").ready(function(){

  
  $("#submitBtn").click(function(){
	 allEdits();
  })
  
  function allEdits(){
	var err = document.getElementsByClassName("error-box")[0];
	var dogName = document.getElementById("dogName").value;
	var age = document.getElementById("age").value;
	var breed = document.getElementById("breed").value;
	var gender = document.getElementById("gender").value;
	var owner = document.getElementById("owner").value;
	var vaccinated = document.getElementById("vaccinated").value;
	
	if (dogName == "") {		
		err.innerText = "Name is required";
		err.classList.remove("hidden");
		document.getElementById("dogName").focus();
		return false;	 	
	} else if (age == "") {		
		err.innerText = "Age is required";
		err.classList.remove("hidden");
		document.getElementById("age").focus();
		return false;	 	
	} else if (breed == "") {		
		err.innerText = "Breed is required";
		err.classList.remove("hidden");
		document.getElementById("breed").focus();
		return false;	 	
	} else if (gender == "") {		
		err.innerText = "Gender is required";
		err.classList.remove("hidden");
		document.getElementById("gender").focus();
		return false;	 	
	} else if (owner == "") {		
		err.innerText = "Owner is required";
		err.classList.remove("hidden");
		document.getElementById("owner").focus();
		return false;	 	
	}  else if (vaccinated == "") {		
		err.innerText = "Vaccination is required";
		err.classList.remove("hidden");
		document.getElementById("vaccinated").focus();
		return false;	 	
	}  else {
		err.classList.add("hidden");
		document.getElementById("addDogForm").submit();
	}  
  }
});	
  	
  </script>
 </html>
