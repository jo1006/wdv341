<?php
// 1. Create a function that will accept a date input and format it into mm/dd/yyyy format.
function mmddYYYYDate($inDate)
{
	return date('m/d/Y');	// formats the output as mm/dd/yyyy
}

// 2. Create a function that will accept a date input and format it into dd/mm/yyyy format to use when working with international dates.
// 1&2 could be combined by passing in a second parameter to determine format to return
function ddmmYYYYDate($inDate)
{
	return date('d/m/Y');	// formats the output as dd/mm/yyyy
}

// 3. Create a function that will accept a string input.  It will do the following things to the string:
//    Display the number of characters in the string
//    Trim any leading or trailing whitespace
//    Display the string as all lowercase characters
//    Will display whether or not the string contains "DMACC" either upper or lowercase
function arrayString($inString)
{
	$strlen = strlen($inString);   				//number of characters in the input string
	$trimString = trim($inString);  			//trim all whitespace
	$lowercaseString = strtolower($inString);   //convert string to lowercase 
	$hasDmacc = substr_count($lowercaseString,"dmacc"); //finds dmacc regardless of case sensitivity
	if ($hasDmacc > 0) 
		{$hasDmacc = "String contains DMACC.";}
	else 
		{$hasDmacc = "String does not contain DMACC.";}
	return $stringArray = array($strlen, $trimString, $lowercaseString, $hasDmacc);
} 

// 4. Create a function that will accept a number and display it as a formatted number.   Use 1234567890 for your testing.
function formatNumber($inNumber)
{
	return number_format($inNumber);  //return number formatted with commas only
}

// 5. Create a function that will accept a number and display it as US currency.  Use 123456 for your testing.
function dollarNumber($inNumber) 
{
	$dollarValue = number_format($inNumber,2);  //format number with commas
	return ("$" . $dollarValue);			  //add $ to make it display as US currency 
}

?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP Functions</title>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>PHP Functions</h2>
<h3></h3>
<p><?php echo mmddYYYYDate(strtotime("today")); ?></p> 
<p><?php echo ddmmYYYYDate(strtotime("today")); ?></p> 
<p><?php $dmaccArray = arrayString("DMACC");
		  echo "There are " . $dmaccArray[0] . " characters in " . $dmaccArray[1] . " (whitespaces removed)." . "</br>";
		  echo $dmaccArray[1] . " as lowercase looks like " . $dmaccArray[2] . ". " . $dmaccArray[3];
	?> </p>
<p><?php echo formatNumber(1234567890); ?></p> 
<p><?php echo dollarNumber(123456); ?></p> 
</body>
</html>