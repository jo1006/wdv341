<?php
	//Get the Event data from the server.
	require 'dbConnect.php'; //access and run this external file 
	date_default_timezone_set('America/Chicago');
	$totalRows = "";

	try {		$totalRows = $conn->prepare("SELECT COUNT(event_id) FROM wdv341_event");
		$totalRows->execute();
		$total = $totalRows->fetchColumn();
	
		$stmt = $conn->prepare("SELECT event_id, event_name, event_description, event_presenter, event_date, event_time, 
			DATE_FORMAT(event_date, '%M %D %Y') dspDate
			FROM wdv341_event 
			ORDER BY event_date DESC");            
		$stmt->execute();
	
	} 
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text_align:left;
			font-size:18px;	
		}
		
		.displayRest {
			margin-left:50px;
		}
	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3><?php echo $total ?> Events are available today.</h3>

<?php
	//Display each row as formatted output in the div below
	while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		if ($result['event_date'] < date("Y-m-d")){
			$style = "";
			$endStyle = "";
		} else if ($result['event_date'] > date("Y-m-d")){
			$style = "<em>";
			$endStyle = "</em>";
		} else {
			$style = "<strong><font color=red>";
			$endStyle = "</strong></font>";
		}	
   
?>
	
	<p>
        <div class="eventBlock">	
            <div>
            	<span class="displayEvent">Event:&nbsp<?php echo $style?><?php echo $result['event_name'] ?><?php echo $endStyle?></span>
                <span>&nbsp&nbsp&nbsp&nbspPresenter:&nbsp<?php echo $result['event_presenter'] ?></span>
            </div>
            <div>
            	<span class="displayRest">Description:&nbsp<?php echo $result['event_description'] ?></span>
            </div>
            <div>
            	<span class="displayRest">Time:&nbsp<?php echo $result['event_time'] ?></span>
            </div>
            <div>
            	<span class="displayRest">Date:&nbsp<?php echo $result['dspDate'] ?></span>
            </div>
        </div>
    </p>
	
<?php
	}
?>
<?php
	//Close the database connection	
	$conn = null;
?>
</div>	
</body>
</html>