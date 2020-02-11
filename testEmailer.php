<html>
<head>
<meta charset="UTF-8">
<title>WDV341 Intro to PHP</title>

</head>
<body>
<h1>wdv341 Intro to PHP</h1>
<h2>Testing the Emailer Class</h2>
<?php
	require 'Emailer.php';   //accesses the class file
	$emailTest = new Emailer(); //instantiating a new Emailer object
	$emailTest->setMessage("In class today we will learn how to create objects and use them in PHP");  
	echo $emailTest->getMessage() . "</br>";
	$emailTest->setRecipientEmail("coupon1006@yahoo.com");  
	echo $emailTest->getRecipientEmail() . "</br>";
	$emailTest->setSenderEmail("jweave37@gmail.com");  
	echo $emailTest->getSenderEmail() . "</br>";
	$emailTest->setSubject("class today");  
	echo $emailTest->getSubject() . "</br>";
	
	if ($emailTest->sendEmail()){
		echo "Successfully sent email";
	} else {
		echo "Email failed";
	}

?>


</body>
</html>