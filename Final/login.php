<?php 
$message = "";
session_start();

	if ($_SESSION['validUser'] == "yes")				//is this already a valid user?
	{
		header('Location: doggyDaycareIndex.php');
		//User is already signed on.  Skip the rest.
		$message = "Welcome Back! $username";	//Create greeting for VIEW area		
	}
	else
	{
		if (isset($_POST['submitLogin']) )			//Was this page called from a submitted form?
		{
			$inUserName = $_POST['loginUsername'];	//pull the username from the form
			$inPassword = $_POST['loginPassword'];	//pull the password from the form
			
			include 'dbConnect.php';				//Connect to the database

			$sql = "SELECT userName, userPassword FROM User WHERE userName = :userName AND userPassword = :userPassword";				
			$stmt = $conn->prepare($sql);  //creates the 'prepared stmt' object

			//bind parameters to the placeholders in the prepared stmt object, one for each parameter
			$stmt->bindParam(':userName', $inUserName);
			$stmt->bindParam(':userPassword', $inPassword);
			
			$stmt->execute(); //no need for an input
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
				
			//echo "<h2>userName: $userName</h2>";
			//echo "<h2>password: $passWord</h2>";
		
			$sql = "SELECT COUNT(*) FROM User WHERE userName = :userName AND userPassword = :userPassword";
			$query = $conn->prepare($sql);  //creates the 'prepared stmt' object
			$query->bindParam(':userName', $inUserName);
			$query->bindParam(':userPassword', $inPassword);
			$query->execute();
			$rowCount = $query->fetchColumn();
			
			if ($rowCount == 1)		//If this is a valid user there should be ONE row only
			{
				$_SESSION['validUser'] = "yes";				//this is a valid user so set your SESSION variable
				$message = "Welcome Back! $inUserName";
				//Valid User can do the following things:
			}
			else
			{
				//error in processing login.  Logon Not Found...
				$_SESSION['validUser'] = "no";					
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}			
			
			$conn = null; //close your connection object
			
		}//end if submitted
		else
		{
			//user needs to see form
		}//end else submitted
		
	}//end else valid user
	
//turn off PHP and turn on HTML
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Login and Control Page</title>

</head>

<body>

<h2><?php echo $message?></h2>

<?php
	if ($_SESSION['validUser'] == "yes")	//This is a valid user.  Show them the Administrator Page
	{
		echo $_SESSION['validUser'];
		header('Location: doggyDaycareIndex.php');
	}
	else									//The user needs to log in.  Display the Login Form
	{
?>
			<h2>Please login to the Doggy Daycare Administrator System</h2>
                <form method="post" name="loginForm" action="login.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
                </form>
                
<?php //turn off HTML and turn on PHP
	} //end of checking for a valid user
			
//turn off PHP and begin HTML			
?>

<p>Return to <a href='doggyDaycareIndex.php'>Doggy Daycare</a></p>

</body>
</html>