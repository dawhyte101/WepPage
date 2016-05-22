<html> 
	<head>
		<meta charset="utf-8" />
			<title>
				HW07 update PHP  CS340 Spring 2015   Dustin Whyte
			</title>
		 
		<link rel="stylesheet" href="styleHW07.css" type="text/css" />
	</head>

	<body>
		<div id="wrapper">

			<header id="header">
				<strong>
					<a href ="..\hw01\hw01.php">HW01</a> |
					<a href ="..\hw02\hw02.php">HW02</a>  |
					<a href ="..\hw03\Hw03.php">HW03</a>  |
					<a href ="..\hw04\hw04.php">HW04</a>  |
					<a href ="..\Hw05\Hw05.php">HW05</a>  |
					<a href ="Hw07.php">HW07</a>  |
					<a href ="Hw07 update.php">HW07 update</a>  |
				</strong>

			</header>
        </div>
        </br></br>
		<div id="content">
		<?php	
				$hostname = "localhost";
				$username = "root";
				$password = "";
				$db_database='cars';
				require_once 'logon.php';
				$db_server = mysql_connect($hostname, $username, $password);
				if (!$db_server) die("unable to connect to MYSQL". mysql_error()); 
			

				if(mysql_select_db($db_database, $db_server))
				{
					//echo 'Connected to database cars<br>';
				}
			
			if (isset($_POST['update']) && isset($_POST['Owner']))
				{
					$updateon=true;
					$Owner=$_POST['Owner'];
					$query = "SELECT * FROM cars WHERE Owner='$Owner'";
					$result = mysql_query($query);
					print_r($result);
					$row= mysql_fetch_row($result);
					print_r($row);
					echo' <form action="HW07.php" method="post"><pre>';
					echo ' Name <input type = "text" name="Name" value="'.mysql_result($result,0,'Name').'"'. PHP_EOL.'>';
					echo 'Color <input type = "text" name="Color" value="'.mysql_result($result,0,'Color').'"'.PHP_EOL.'>';
					echo 'Owner <input type = "text" name="Owner" value="'.mysql_result($result,0,'Owner').'"'.PHP_EOL.'>';
					echo 'Miles <input type = "int" name="Miles" value='.mysql_result($result,0,'Miles').PHP_EOL.'>';
					echo 'Year <input type = "int" name="Year" value='.mysql_result($result,0,'Year').PHP_EOL.'>';
					echo ' <input type = "hidden" name="update" value="yes">';
					echo ' <input type = "hidden" name="oldName" value="' . mysql_result($result,0,'Name'). '">';
					echo '<input type="submit" value="UPDATE RECORD"/>';
					echo '</pre></form>';
				}
				
				mysql_close($db_server);
		?>
	</body>
</html>