<!DOCTYPE>
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
		#result{
			text-align: center;
			padding-top: 10px;
			padding-bottom: 10px;
			margin-top: 40px;
			margin-left: 300px;
			margin-right: 300px;
			font-size: 25px;
			background-color: #D44949;
			color: #ffffff;
		}
		#Table{
			margin-top: 20px;
			margin-left: 350px;
			margin-right: 300px;

		}
		#TH{
			text-align: center;
			font-size: 20px;
			padding: 15px 15px 15px 15px;
			color: #ffffff;
			background-color: #D44949;
		}
		#TD{
			text-align: center;
			font-size: 22px;
		}
	</style>
</head>
<body>

<?php
$pdo = new PDO("mysql:host=localhost;dbname=train","root","");

$stmt = $pdo->prepare("SELECT * FROM schedule WHERE depart=? AND arrive=?");

$stmtClass = $pdo->prepare("SELECT * FROM schedule WHERE depart=? AND arrive=? AND class=?");

$_depart = $_GET['From'];
$_arrive = $_GET['To'];
$_class = $_GET['Type'];
    
$b = ($_depart !== $_arrive);
$R = '';
if ($b){
        $stmt->execute(array($_depart, $_arrive));
        $Rwz = $stmt->fetchAll();
        if (count($Rwz) < 1 )
            $R = 'No Trains for selected stations';
        elseif (count($Rwz)>0 && $_class != 'ALL'){
            $stmtClass->execute(array($_depart, $_arrive, $_class));
            $Rwz = $stmtClass->fetchAll();
            if (count($Rwz) < 1 )
                $R = 'No Trains for selected stations with this class';
        }
} else
        $R = 'No Trains from a station to itself';

?>
	<div id="Head">
		Egypt Trains
	</div>

	<div id="result">
		<?php
			echo "From ".$_GET['From']." To ".$_GET['To'];
		?>
		
	</div>
	<div id="Table">
		<table>
			<tr>
				<th id="TH">Train</th>
            	<th id="TH">Depart Time</th>
            	<th id="TH">Arrives Time</th>
            	<th id="TH">Degree</th>
            	<th id="TH">Price</th>
			</tr>
			<?php
				if ($R!='')
					echo "<td id=\"TD\" colspan=\"5\"> $R </td>";
				else{
					$Out=false;
					foreach($Rwz as $r){
            			echo "<tr>";
            			echo "<td id=\"TD\"> $r[id] </td>";
            			echo "<td id=\"TD\"> $r[depart_time] </td>";
            			echo "<td id=\"TD\"> $r[arrive_time] </td>";
            			echo "<td id=\"TD\"> $r[class] </td>";
            			echo "<td id=\"TD\"> $r[price] </td>";
            			echo "</tr>";
            			$Out = true;
        			}
        			if ($Out===false)
        				echo "<td id=\"TD\" colspan=\"5\"> NO Trains From $_GET[From] To $GET[TO]</td>";
        		}
			?>
		</table>
	</div>
</body>
</html>