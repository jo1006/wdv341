<?php
//alert("insideGetDog");
	require 'dogContainer.php';   //accesses the class file
	require 'dbConnect.php'; //access and run this external file
try {	
	$dogID = $_GET['id'];
  
	$dog = new dogContainer();
	$sql = "SELECT dogID, dogName, breed, age, gender, vaccinated, owner FROM Dog WHERE dogID = :dogID";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':dogID', $dogID); //bind dogID parameter!!!!! to prevent sql injection threats
		
	$stmt->execute(); //no need for an input
	//fetch association takes sql response object need to turn into a php obj/associated array chg structure so next language can read it
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$dog->set_id($result['dogID']);
	$dog->set_name($result['dogName']);
	$dog->set_breed($result['breed']);
	$dog->set_age($result['age']);
	$dog->set_gender($result['gender']);
	$dog->set_vaccinated($result['vaccinated']);
	$dog->set_owner($result['owner']);
	
} catch (PDOException $e){
    echo $e.message;
}
// below stays the same
	$returnObj = json_encode($dog);	//create the JSON object in php object
//	
	echo $returnObj;
	
?>	