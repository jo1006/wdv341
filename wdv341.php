<?php 

	$firstName = "JoAnn"; //datatype:string  scope:global
	$lastName = "Weaver"; //datatype:string  scope:global
	

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>WDV341 Intro to PHP</title>
<!-- JoAnn Weaver	
	 01/19/2020
-->
     
</head>
<body>
	<h1>WDV341 Intro PHP - Monday Night</h1>
	<h2><?php echo $firstName." ".$lastName ?></h2> 
	
	<?php
	
		echo "<h3>Homework Links</h3>";
		echo '<a href = "phpBasics.php">PHP Basics</a><br>';
		echo '<a href = "phpFunctions.php">PHP Functions</a><br>';
		echo '<a href = "testEmailer.php">PHP Test Emailer</a><br>';
		echo '<a href = "exampleForm.html">PHP Forms</a><br>';
		
	?>
	

<body>
</html>