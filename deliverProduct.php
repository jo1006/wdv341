<?php

	require 'ProductContainer.php';   //accesses the class file
	
	$productObj = new ProductContainer(); //make the class do like emailer classs
	
    $productObj->set_name("PHP Textbook");
 	$productObj->set_price("$129.95");
 	$productObj->set_pageCount("327");
	$productObj->set_ISBN("13-1234435690");


// below stays the same
	$returnObj = json_encode($productObj);	//create the JSON object in php object
//	
	echo $returnObj;							//send results back to calling program
?>