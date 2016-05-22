<html>
 <head>
  <title>HW04 PHP Test  CS340 Spring 2015   Dustin Whyte</title>
 </head>
<a href="..\hw01\hw01.php">HW01</a>
<a href="..\hw02\hw02.php">HW02</a> 
<a href="..\hw03\Hw03.php">HW03</a> 
<a href="hw04.php">HW04</a> 
<a href="..\Hw05\Hw05.php">HW05</a> 
<a href ="..\Hw07\Hw07.php">HW07</a>
<a href ="..\hw07\Hw07 update.php">HW07 update</a>
<a href="..\Midterm\CS340Midterm.php">Midterm</a>
 <body>

	<?php
		echo '<p>HW04 CS340 Spring 2014 Dustin Whyte</p> <br/>';
		echo date("l, F, jS");
		echo '<br/>';  
	
		require_once ('logon.php');
		$db_server = new mysqli ($hostname, $username, $password);
		if (!$db_server);

		mysql_selectdb($database) or die("Unable to select database:" . mysql_error());
		/*$query = "SELECT * FROM cars";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		echo'<table>';
		echo'<table border ="3" cellspacing="1" callpadding="1">';
		//echo'<tr><td><h1>AWESOME CARS</h1></td></tr>';
		
		
		for ($j=0; $j<$rows;++$j)
		{ 
		echo'<tr><td> '.mysql_result($result,$j,'Name'). '<br/>'.'</td>';
		echo'<td> '.mysql_result($result,$j,'Color'). '<br/>'.'</td>';
		echo'<td> '.mysql_result($result,$j,'Owner'). '<br/>'.'</td>';
		echo'<td> '.mysql_result($result,$j,'Miles'). '<br/>'.'</td>';
		echo'<td> '.mysql_result($result,$j,'Year'). '<br/>'.'</td></tr>';
		}
		echo'</table>';*/
	?>

        <?php
			$createBackup = "CREATE DATABASE HW04bk;";
			$createBK_result = $db_server->query($createBackup);
			if(!$createBK_result)
			{
				echo "database HW04bk already exists on " . $hostname . "<br>";
			}
			
			else
			{
				echo "database hw04bk created successfully.<br>";
				$createTable = "CREATE TABLE hw04bk.cars
								(
									Name varchar(50), 
									Color varchar(50), 
									Owner varchar(30),
									Miles varchar(30),
									Year char(4),
									primary key(Name,Owner,Year)
								) ENGINE MyISAM;";
				$createTB_result = $db_server->query($createTable);
				if($createTB_result)
				{
					echo "table created successful<br>";
				}
				
				else
				{
					echo $createTB_result . "Did not work<br>";
				}	
				
				$insertCopy = "insert into hw04bk.cars select * from cars.cars;";//copies from hw03 to bk
				$result = $db_server->query($insertCopy);
				if($result)
				{
					echo "copy successful<br>";
				}
				
				$dropTable = "drop table cars.cars;";
				$dropTB_result = $db_server->query($dropTable);
				
				if($dropTB_result)
				
					echo "deleted cars from cars successfully<br>";
				
				$newInsert1 ="insert into hw04bk.cars values('Yugo GV','Black','Richard','120000','1985')";
				$db_server->query($newInsert1);
				
				$newInsert2 ="insert into hw04bk.cars values('Honda Odyssey','Yellow','Lisa','549','2013')";
				$db_server->query($newInsert2);
				
				$newInsert3 ="insert into hw04bk.cars values('Mitsubishi PX33','Dark Blue','Justin','247','1950')";
				$db_server->query($newInsert3);
				
				$newInsert4 ="insert into hw04bk.cars values('Shelby GT350','White and Blue','Tanner','120000','1985')";
				$db_server->query($newInsert4);
				
				$newInsert5 ="insert into hw04bk.cars values('Lotus Exige','Black','Bryce','0','2000')";	
				$db_server->query($newInsert5);
				
				$newInsert6 ="insert into hw04bk.cars values('Red Bull X1 Prototype','Blue','Dustin','0','2012')";	
				$db_server->query($newInsert6);
				
				echo "all inserts successful<br>";
			
				$recreateTable = "CREATE TABLE cars.cars
								(
									Name varchar(50), 
									Color varchar(50), 
									Owner varchar(30),
									Miles varchar(30),
									Year char(4),
									primary key(Name,Owner,Year)
								) ENGINE MyISAM;";
				$recreateTB_result = $db_server->query($recreateTable);
				if($recreateTB_result)
				{
					echo "table cars recreated successfully in cars<br>";
				}
				
				$update = "insert into cars.cars select * from hw04bk.cars;";
				$updateResult = $db_server->query($update);
			
				if($updateResult)
				{
					echo "cars table updated successful<br>";
				}
			}
				$query = "SELECT * FROM cars.cars;";
				$result = $db_server->query($query);
				if (!$result) die ("Database access failed: " . mysqli_error()); 
            
			echo'<table border ="3" cellspacing="1" callpadding="1">';
			echo'<tr><td><h1>AWESOME CARS</h1></td></tr>';
		    echo'<tr><td>Name</td><td>Color</td><td>Owner</td><td>Miles</td><td>Year</td></tr>';
			
			//$num_rows = mysqli_num_rows($result);
			
           //for ($j=0; $j < $num_rows;++$j)
		   while($row = mysqli_fetch_assoc($result))
            {
				echo '<tr><td> '. $row['Name'] .'<br/>'.'</td>';
				echo '<td> '.$row['Color'] .'<br/>'.'</td>';
				echo '<td> '.$row['Owner'] .'<br/>'.'</td>';
				echo '<td> '.$row['Miles'] .'<br/>'.'</td>';
				echo '<td> '.$row['Year'] .'<br/>'.'</td></tr>';
				//$awesome = $row['Name'];
			}

            echo'</table>'
           
        ?>
	</body>	
</html>