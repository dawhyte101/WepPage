<html>
 <head>
  <title>HW03 PHP Test  CS340 Spring 2015   Dustin Whyte</title>
 </head>
<a href="..\hw01\hw01.php">HW01</a>
<a href="..\hw02\hw02.php">HW02</a> 
<a href="Hw03.php">HW03</a> 
<a href="..\hw04\hw04.php">HW04</a> 
<a href="..\Hw05\Hw05.php">HW05</a>
<a href ="..\Hw07\Hw07.php">HW07</a>
<a href ="..\hw07\Hw07 update.php">HW07 update</a>
<a href="..\Midterm\CS340Midterm.php">Midterm</a>
 <body>
	<?php
		echo '<p>HW03 CS340 Spring 2014 Dustin Whyte</p> <br/>';
		echo date("l, F, jS");
		echo '<br/>';  
	
		require_once ('logon.php');
		$db_server = new mysqli ($hostname, $username, $password);
		if (!$db_server);
		
		$yo = fopen("hw03out.txt", 'w') or die ("failed");
		
		mysql_selectdb($db_database) or die("Unable to select database:" . mysql_error());
		$query = "SELECT * FROM cars";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		//echo "numrows = " . $rows . "<br>";
		echo'<table border ="3" cellspacing="1" callpadding="1">';
		echo'<tr><td><h1>AWESOME CARS</h1></td></tr>';
		
		for ($j=0; $j<$rows;++$j)
		{ 
		echo '<tr><td> '.mysql_result($result,$j,'Name'). '<br/>'.'</td>';
		echo '<td> '.mysql_result($result,$j,'Color'). '<br/>'.'</td>';
		echo '<td> '.mysql_result($result,$j,'Owner'). '<br/>'.'</td>';
		echo '<td> '.mysql_result($result,$j,'Miles'). '<br/>'.'</td>';
		echo '<td> '.mysql_result($result,$j,'Year'). '<br/>'.'</td></tr>';
		$awesome = mysql_result($result,$j,'Name');
		
		fwrite($yo, $awesome);
		}
		fclose($yo);
		echo'</table>';
		
	?>
	</body>	
</html>