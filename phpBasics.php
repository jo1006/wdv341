<?php 

	$yourName = "JoAnn"; //datatype:string  scope:global
	$number1 = 11;
	$number2 = 22;
	$total = $number1 + $number2;
	
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Basics</title>
<!-- JoAnn Weaver	
	 01/20/2020
-->
	 
</head>
<script type="text/javascript">
	<?php 
		$php_webArray = array('PHP', 'HTML', 'JavaScript');
		$js_webArray = json_encode($php_webArray);
		echo  $js_webArray;
	?> 
</script>
<body>
	<?php echo "<h1> $yourName </h1>"; ?> 
	<h2><?php echo $yourName; ?></h2>
	<h3><?php echo $number1. " + " .$number2. " = " .$total ?></h3>
	
	<?php echo $js_webArray ?>
<body>

</html>