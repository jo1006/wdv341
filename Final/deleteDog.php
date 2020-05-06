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
		echo "Error: " . $e->getMessage();
		error_log("cant get dog for delete dog name select", 1,"coupon1006@yahoo.com");
	}
	
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Delete Dog</title>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/daycarestyle.css" type="text/css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<script>
	function getDogObject(str) { 
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() { //state goes from 0(create obj) 4(completed)
		  if (this.readyState == 4 && this.status == 200) { //status of 200 successful
			 // console.log(this.responseText);  
			  
			var myObj = JSON.parse(this.responseText); //take from json and putting into javascript stored in myObj
			document.getElementById("age").innerHTML = myObj.age; //put value in field on browser
			document.getElementById("breed").innerHTML = myObj.breed; //put value in field on browser
			document.getElementById("owner").innerHTML = myObj.owner; //put value in field on browser
			document.getElementById("dogID").value = myObj.dogID; //put value in field on browser
		
			if (myObj.gender == "M"){ //make these selected vs not
				document.getElementById("gender").innerHTML = "Male"; //put value in field on browser
			} else {
				document.getElementById("gender").innerHTML = "Female"; //put value in field on browser
			}
	
			if (myObj.vaccinated == "Y"){		
				document.getElementById("vaccinated").innerHTML = "Yes"; //put value in field on browser
			} else {
				document.getElementById("vaccinated").innerHTML = "No"; //put value in field on browser
			}
		  }
		};
		
		xmlhttp.open("GET", "getDog.php?id="+str, true);  //
		xmlhttp.send();		//starts process	
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
			echo '<a href="updateDog.php">Update</a>';
			echo '<a href="">Delete</a>';
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
		<form id="deleteDogForm" action="deleteDogDb.php" method="post">
			<h2 align="center">Delete Dog</h2>
			</br>
			<div class="form-group row">
				<div class="error-box hidden col-sm-6 col-sm-offset-3 text-center"></div>
			</div>
			<div class="form-group row"> 
				<label for="dogName" class="col-sm-3 col-form-label text-right">Name</label>
				<div class="col-sm-3">
					<select id="dogName" name="dogName" class="form-control" onchange="getDogObject(this.value)">
					<?php foreach ((new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){ ?>
						<option value=<?php echo $v['dogID'];?>><?php echo $v['dogName'];?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group row"> 
				<label class="col-sm-4 col-form-label text-right">Age: </label>
				<label id="age" class="col-sm-4 col-form-label"></label>
			</div>
			<div class="form-group row"> 
				<label class="col-sm-4 col-form-label text-right">Breed: </label>
				<label id="breed" class="col-sm-4 col-form-label"></label>
			</div>
			<div class="form-group row"> 
				<label class="col-sm-4 col-form-label text-right">Gender: </label>
				<label id="gender" class="col-sm-4 col-form-label"></label>
			</div>
			<div class="form-group row"> 
				<label class="col-sm-4 col-form-label text-right">Owner: </label>
				<label id="owner" class="col-sm-4 col-form-label"></label>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label text-right">Vaccinated: </label>
				<label id="vaccinated" class="col-sm-4 col-form-label"></label>
			</div>
			<input id="dogID" type="hidden" name="dogID" value="">
			<div class="form-group row">
				<button id="submitBtn" class="col-sm-2 col-sm-offset-5" type="button">Delete</button>
			</div>
			<br>
		</form>
	  </div>
  </body>
  <script type="text/javascript">
$("document").ready(function(){

  
  $("#submitBtn").click(function(){
	var ok = confirm("Are you sure you want to delete?");
	 if (ok) { 
		document.getElementById("deleteDogForm").submit();
	 }
  })
  
});	
</script>
 </html>