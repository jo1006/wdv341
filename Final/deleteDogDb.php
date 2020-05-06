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
    
    $dogID = $_POST["dogID"];		//Get the value entered in the dogID hidden field
	
    //pdo prepared stmts
    //1. create the sql stmt with name placeholders //(dogName, age, breed, gender, owner, vaccinated)
    $sql = "DELETE FROM Dog 
	WHERE dogID= :dogID"; //not ?,? 
	
    //2. create the prepared stmt object
    $stmt = $conn->prepare($sql);  //creates the 'prepared stmt' object

    //3. bind parameters to the placeholders in the prepared stmt object, one for each parameter
    $stmt->bindParam(':dogID', $dogID);
	
	//4. execute the prepared stmt
    $stmt->execute(); //no need for an input
	$conn = null; //close your connection object
	echo "<script> alert('Successfully deleted dog'); window.location.href='deleteDog.php';</script>;";
	
} catch (PDOException $e){
    echo $e.message;
	echo "<script> alert('An error occured. Please try again later')</script>";
	error_log("Trouble deleting dog in db", 1,"coupon1006@yahoo.com");
}
$conn = null; //close your connection object
header('Location: ./deleteDog.php');
?>
