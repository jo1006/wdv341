<?php
	require 'Emailer.php';   //accesses the class file
	
	$inEmail = "";
	$inFirstName = "";
	$inLastName = "";
	$inSubject = "";
	$inMsg = "";
	$inErrMsg = "";
	
	if(isset($_POST["submitSend"])){
			$inEmail = $_POST['email'];
			$inFirstName = $_POST['first'];
			$inLastName = $_POST['last'];
			$inSubject = $_POST['subject'];
			$inMsg = $_POST['msg'];
	
		

			if ($inEmail == "") {
				$inErrMsg ="Email is required";
				$validForm = false;
			} else if ($inFirstName == "") {
				$inErrMsg ="First Name is required";
				$validForm = false;
			} else if ($inLastName == "") {
				$inErrMsg ="Last Name is required";
				$validForm = false;
			} else if ($inSubject == "") {
				$inErrMsg ="Subject is required";
				$validForm = false;
			} else if ($inMsg == "") {
				$inErrMsg ="The message is required";
				$validForm = false;
			} else {
				$validForm = true;
			}
	
		if($validForm) {
			$email = new Emailer(); //instantiating a new Emailer object
			
			$email->setMessage($inMsg);  
			$email->setRecipientEmail("coupon1006@yahoo.com"); 
			$email->setSenderEmail($inEmail);  
			$email->setSubject($inSubject);  
		
			if ($email->sendEmail()){
				echo "<script> alert('Successfully sent email'); window.location.href='doggyDaycareIndex.php';</script>";
			}  else {
				echo "<script> alert('Email failed'); window.location.href='doggyDaycareIndex.php';</script>";
			}
		}	
	}		
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>WDV341 Intro to PHP</title>

</head>
<body>
<h1>Doggy Daycare</h1>
<h2>Drop me a note about your pup!</h2>

<form method="post" name="emailForm" action="email.php" >
	<p><?php echo $inErrMsg ?>&nbsp</p>
    <p>First Name: <input id="first" name="first" type="text" value="<?php echo $inFirstName ?>"/></p>
    <p>Last Name: <input id="last" name="last" type="text" value="<?php echo $inLastName ?>"/></p>
    <p>Your Email: <input id="email" name="email" type="text" value="<?php echo $inEmail ?>"/></p>
    <p>Subject: <input id="subject" name="subject" type="text" value="<?php echo $inSubject ?>"/></p>
    <p><textarea id="msg" name="msg" rows="5" cols="40" /></textarea><?php echo $inMsg ?></p>
    <p><input name="submitSend" value="Send" type="submit" /> <input name="" type="reset" />&nbsp;</p>
</form>

<p>Return to <a href='doggyDaycareIndex.php'>Doggy Daycare</a></p>


</body>
</html>