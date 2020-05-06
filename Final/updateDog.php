<?php
session_start();

	//Get the Event data from the server.
	require 'dbConnect.php'; //access and run this external file 
	 
	try {
	
		$stmt = $conn->prepare("SELECT dogID, dogName, breed, age, gender, vaccinated, owner 
			FROM Dog");
			
		$stmt->execute();	
	} 
	catch(PDOException $e) {
		error_log("cant get dog for update dog name select", 1,"coupon1006@yahoo.com");
		echo "Error: " . $e->getMessage();
	}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Dog</title>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/daycarestyle.css" type="text/css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<script>
	function getDogObject(str) { 
		if (str == "") {
			alert("Please choose a dog");
		}
		else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() { //state goes from 0(create obj) 4(completed)
			  if (this.readyState == 4 && this.status == 200) { //status of 200 successful
				  //console.log(this.responseText);  
				  
				var myObj = JSON.parse(this.responseText); //take from json and putting into javascript stored in myObj
				document.getElementById("age").value = myObj.age; //put value in field on browser
				document.getElementById("breed").value = myObj.breed; //put value in field on browser
				document.getElementById("owner").value = myObj.owner; //put value in field on browser
				document.getElementById("dogID").value = myObj.dogID; //put value in field on browser
			
				if (myObj.gender == "M"){ //make these selected vs not
					document.getElementById("gender").value = "M"; //put value in field on browser
				} else {
					document.getElementById("gender").value = "F"; //put value in field on browser
				}
		
				if (myObj.vaccinated == "Y"){		
					document.getElementById("vaccinated").value = "Y"; //put value in field on browser
				} else {
					document.getElementById("vaccinated").value = "N"; //put value in field on browser
				}
			  }
			}
		
			xmlhttp.open("GET", "getDog.php?id="+str, true);  //
			xmlhttp.send();		//starts process
		}
	}
	</script>
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
			echo '<a href="">Update</a>';
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
		<form id="updateDogForm" action="updateDogDb.php" method="post">
			<h2 align="center">Update Dog</h2>
			</br>
			<div class="form-group row">
				<div class="error-box hidden col-sm-6 col-sm-offset-3 text-center"></div>
			</div>
			<div class="form-group row"> 
				<label for="dogName" class="col-sm-3 col-form-label text-right">Name</label>
				<div class="col-sm-3">
					<select id="dogName" name="dogName" class="form-control" onchange="getDogObject(this.value)">
						<option value=""></option>
					<?php foreach ((new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){ ?>
						<option value=<?php echo $v['dogID'];?>><?php echo $v['dogName'];?></option>
					<?php } ?>
					</select>
				</div>
				<label for="age" class="col-sm-1 col-form-label text-right">Age</label>
				<div class="col-sm-1">
					<input id="age" name="age" type="text" class="form-control" value="">
				</div>
			</div>
			<div class="form-group row"> 
				<label for="breed" class="col-sm-3 col-form-label text-right">Breed</label>
				<div class="col-sm-3">
					<input id="breed" name="breed" type="text" class="form-control" value="">
				</div>
				<label for="gender" class="col-sm-1 col-form-label text-right">Gender</label>
				<div class="col-sm-2">
					<select id="gender" name="gender" class="form-control">
						<option value="M" selected>Male</option>
						<option value="F" >Female</option>
					</select>
				</div>
				
			</div>
			<div class="form-group row"> 
				<label for="owner" class="col-sm-3 col-form-label text-right">Owner</label>
				<div class="col-sm-4">
				  <input id="owner" name="owner" type="text" class="form-control" value="">
				</div>
			</div>
			<div class="form-group row">
				<label for="vaccinated" class="col-sm-3 col-form-label text-right">Vaccinated</label>
				<div class="col-sm-2">
					<select id="vaccinated" name="vaccinated" class="form-control">
						<option value="Y" selected>Yes</option>
						<option value="N" >No</option>
					</select>
				</div>
			</div>
			<input id="dogID" type="hidden" name="dogID" value=""> 
			<div class="form-group row">
				<button id="submitBtn" class="col-sm-2 col-sm-offset-5" type="button">Update</button>
			</div>
			<br>
		</form>
	  </div>
  </body>
  <script type="text/javascript">
$("document").ready(function(){

  
  $("#submitBtn").click(function(){
//	 e.preventDefault();
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
		debugger;
		document.getElementById("updateDogForm").submit();
	}  
  }
});	
</script>
 </html>