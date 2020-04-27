<!DOCTYPE html>
<html>
<body>

<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>EventID</th><th>EventName</th><th>EventDescription</th><th>EventPresenter</th><th>EventDate</th><th>EventTime</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

require 'dbConnect.php'; //access and run this external file 

try {
	
	$stmt = $conn->prepare("SELECT event_id, event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event WHERE event_id='15'");
	$stmt->execute();
	
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }



} 
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}

echo "</table>";
$conn = null;

?>
</body>
</html>