<!DOCTYPE >
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-image: url("images.jpg");
			background-repeat: no-repeat;
			background-size: 1500px 700px;
		}
		#Head{
			background-color: #D44949;
			padding-top: 20px;
			padding-bottom: 20px;
			padding-right: 0px;
			padding-left: 10px;
			color: #ffffff;
			font-weight: bold;
			font-style: normal;
			font-size: 30px;
		}
		#Body{
			text-align: center;
		}
		#Items{
			margin-top: 50px;
			height: 75px;
			width: 500px;
			text-align: left;
			font-size: 25px;
			padding-right: 10px;
			padding-left: 10px;
			color: #7E7373;
		}
		#GO{
			background-color: #D44949;
			color: #ffffff;
			margin-top: 15px;
			height: 70px;
			width: 500px;
			font-size: 25px;
			padding-right: 10px;
			padding-left: 10px;
		}
	</style>
</head>
<body>
<?php

$zerO = new PDO("mysql:host=localhost;dbname=train", "root", "");
$zerO->exec('use train');

$stmt = "SELECT DISTINCT depart FROM schedule;";
$sqll = $zerO->prepare($stmt);
$sqll->execute(array());
$cities_from = $sqll->fetchAll();

$stmt = "SELECT DISTINCT arrive FROM schedule;";
$sqll = $zerO->prepare($stmt);
$sqll->execute(array());
$cities_to = $sqll->fetchAll();

$stmt = "SELECT DISTINCT class FROM schedule;";
$sqll = $zerO->prepare($stmt);
$sqll->execute(array());
$classes = $sqll->fetchAll();
?>

	<div id="Head">
		Egypt Trains
	</div>

	<div id="Body">
		<form action="GO.php" method="get">
			
			<select name="From" id="Items">
				<?php
					foreach ($cities_from as $c)
        				echo "<option> $c[depart] </option>";
				?>
			</select><br>

			<select name = "To" id="Items">
				<?php
					foreach ($cities_to as $c)
        				echo "<option> $c[arrive] </option>";
				?>
			</select><br>

			<select name="Type" id="Items">
				<?php
					foreach ($classes as $c)
        				echo "<option> $c[class] </option>";	
				?>
			</select><br>

			<input type="submit" name="submit" id="GO" value="Show Trains">
		</form>
	</div>
</body>
</html>