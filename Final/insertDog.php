<?php
//it will pull the form data from the $_POST variable
//1. it will format an insert sql statement
//2. it will create a prepared statement
//3. it will bind the parameters to the prepared stmt
//4. it will execute the prepared stmt to insert into the db
//it will display a success/falure msg to the user
//site key 6LfmJt4UAAAAAPV5loR6-FhC79wHNn_GapVe_DNL

require 'dbConnect.php'; //access and run this external file 

try {
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
    {
        $secretKey = "6LfmJt4UAAAAANwyqC_iJXroQ1__C1zJ5Z1ryKOK";
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {
            $succMsg = 'Your contact request have submitted successfully.';
        }
        else
        {
            $errMsg = 'Robot verification failed, please try again.';
        }
    }

    //pulls the individual name-value pairs from the $_POST using the name
    //as the key in an associative array.  	
    
    $dogName = $_POST["dogName"];		//Get the value entered in the dogName field
	$age = $_POST["age"];		//Get the value entered in the age field
	$breed = $_POST["breed"];			//Get the value entered in the breed field
	$gender = $_POST["gender"];		//Get the value entered in the gender field
	$owner = $_POST["owner"];			//Get the value entered in the owner field
	$vaccinated = $_POST["vaccinated"];			//Get the value entered in the vaccinations field
	
    //pdo prepared stmts
    //1. create the sql stmt with name placeholders
    $sql = "INSERT INTO Dog (dogName, age, breed, gender, owner, vaccinated)
    VALUES (:dogName, :age, :breed, :gender, :owner, :vaccinated)"; //not ?,? 
	
    //2. create the prepared stmt object
    $stmt = $conn->prepare($sql);  //creates the 'prepared stmt' object
	
    //3. bind parameters to the placeholders in the prepared stmt object, one for each parameter
    $stmt->bindParam(':dogName', $dogName);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':breed', $breed);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':owner', $owner);
    $stmt->bindParam(':vaccinated', $vaccinated);

    //4. execute the prepared stmt
    $stmt->execute(); //no need for an input
	$conn = null; //close connection before leaving page
	echo "alert('Successfully added dog'); window.location.href='addDog.php';</script>;";
	
} catch (PDOException $e){
    echo $e.message;
	echo "alert('An error occured. Please try again later')";
	error_log("Trouble adding dog to db", 1,"coupon1006@yahoo.com");
}
$conn = null; //close your connection object
header('Location: ./addDog.php');
?>




