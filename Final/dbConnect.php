<?php
//PHP PDO Connection file
//this file is used to connect to a database
//include this file in your application as needed
//make 1 for each project
//put this in your git .ignore file

$serverName = 'localhost';
$userName = 'root'; //user name of your database
$password = ''; //password of your database
$databaseName = 'wdv341'; //name of the database you will be accessing

//$serverName = 'localhost';
//$userName = 'jmweaver2_daycare'; //user name of your database
//$password = 'Mia1234!'; //password of your database
//$databaseName = 'jmweaver2_daycare'; //name of the database you will be accessing

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //uppercase they are predefined or constants
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }



?>