<?php
//this php file will connect to the wdv341 db
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
    
    $eventName = $_POST["eventName"];		//Get the value entered in the event name field
	$eventDescription = $_POST["eventDescription"];		//Get the value entered in the event Description field
	$eventPresenter = $_POST["eventPresenter"];			//Get the value entered in the eventPresenter field
	$eventDate = $_POST["eventDate"];		//Get the value entered in the event Date field
	$eventTime = $_POST["eventTime"];			//Get the value entered in the event Time field

    //pdo prepared stmts
    //1. create the sql stmt with name placeholders
    $sql = "INSERT INTO wdv341_event (event_name, event_description, event_presenter, event_date, event_time)
    VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)"; //not ?,? 

    //2. create the prepared stmt object
    $stmt = $conn->prepare($sql);  //creates the 'prepared stmt' object

    //3. bind parameters to the prepared stmt object, one for each parameter
    $stmt->bindParam(':eventName', $eventName);
    $stmt->bindParam(':eventDescription', $eventDescription);
    $stmt->bindParam(':eventPresenter', $eventPresenter);
    $stmt->bindParam(':eventDate', $eventDate);
    $stmt->bindParam(':eventTime', $eventTime);

    //4. execute the prepared stmt
    $stmt->execute(); //no need for an input
} catch (PDOException $e){
    echo "Broken!";
}
$conn = null; //close your connection object

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> </title>
</head>
<body>
<h1> It worked! </h1>

</body>
</html>