<html> 
	<head>
		<meta charset="utf-8" />
			<title>
				HW07 PHP  CS340 Spring 2015   Dustin Whyte
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
				</strong>

			</header>
        </div>
        </br></br>
		<div id="content">
			<?php
				echo date("l, F, jS");
				echo '<br/>';
				$updateon=false;
   
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
				//echo $_POST['delete'];
				//echo $_POST['Company'];
				if (isset( $_POST ['update']))
				{
					$Name = get_post('Name');
					$Color = get_post('Color');
					$Owner = get_post('Owner');
					$Miles = get_post('Miles');
					$Year = get_post('Year');
					$oldName = get_post('oldName');
     
					$query = "update cars SET Name='$Name', Color = '$Color', Owner = '$Owner', Miles = $Miles, Year = $Year WHERE Name = '$oldName'";
					echo $query . "<br>";
					if(mysql_query($query, $db_server))
					{
					echo 'update successful';
					}
				}
				
				if (isset($_POST['delete']) && isset($_POST['Owner']))
				{
					$Owner=$_POST['Owner'];
					echo $Owner;
					$query = "DELETE FROM cars WHERE Owner='$Owner'";
					if (!mysql_query($query, $db_server))
						echo "Delete failed: $query<br/>".mysql_error()."<br/><br/>";    
				}
				
				$nameFilter = 1;
				if (isset ($_POST['Filter']))
				{
					$nameFilter = "Name LIKE '%" . get_post('Name') . "%'"; 
				}
				
				if  (isset($_POST['Name'])&&
				isset($_POST['Color'])&&
				isset($_POST['Owner'])&&
				isset($_POST['Miles'])&&
				isset($_POST['Year']) &&
				isset($_POST['addButton']))
				{
					$Title = get_post('Name');
					$Color = get_post('Color');
					$Owner = get_post('Owner');
					$Miles = get_post('Miles');
					$Year = get_post('Year');
     
					$query = "INSERT INTO cars VALUES".
					"('$Title', '$Color', '$Owner', '$Miles', '$Year')";
					if (!mysql_query($query, $db_server))
					echo "Insert failed: $query<br/>".mysql_error()."<br/><br/>";
				}

				echo' <form action="HW07.php" method="post"><pre>';
				echo ' Name <input type = "text" name="Name">';
				echo ' Color <input type = "text" name="Color">';
				echo ' Owner <input type = "text" name="Owner">';
				echo ' Miles <input type = "int" name="Miles">';
				echo ' Year <input type = "int" name="Year">';
				echo '<input type = "hidden" name = "addButton" value = "yes">';
				echo '<input type="submit" value="ADD RECORD">';
				echo '</pre></form><br>';
				
				echo' <form action="HW07.php" method="post"><pre>';
				echo ' Name <input type = "text" name="Name">';
				echo '<input type="hidden" name="Filter" value = "yes">';
				echo '<input type="submit" value="Filter">
				
</pre></form>';
				
				$query = "SELECT * FROM cars where $nameFilter;";
				echo $query . "<br>";
				$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				echo '<table>';
				echo '<tr><th><h4>Name</h4></th><th><h4>Color</h4></th><th><h4>Owner</h4></th><th><h4>Miles</h4></th><th><h4>Year</h4></th></tr>';
 
				for ($j=0; $j<$rows;++$j)
				{
					$row= mysql_fetch_row($result);
  
					echo'<tr><td> '.mysql_result($result,$j,'Name').PHP_EOL.'</td>';
					echo'<td> '.mysql_result($result,$j,'Color'). '<br/>'.'</td>';
					echo'<td> '.mysql_result($result,$j,'Owner'). '<br/>'.'</td>';
					echo'<td> '.mysql_result($result,$j,'Miles'). PHP_EOL.'</td>';
					echo'<td> '.mysql_result($result,$j,'Year'). '<br/>'.'</td>';
  
					echo'<td> <form action="HW07.php" method="post">';
					echo ' <input type = "hidden" name="delete" value="yes">';
					echo ' <input type = "hidden" name="Owner" value="' .mysql_result($result,$j,'Owner').'">';
					echo ' <input type = "submit" value="delete"></form></td>';
					echo'<td> <form action="HW07 update.php" method="post">';
					echo ' <input type = "hidden" name="update" value="yes">';
					echo ' <input type = "hidden" name="Owner" value="'.mysql_result($result,$j,'Owner').'">';
					//the following also works fine:
					echo ' <input type = "submit" value="update"/></form></td></tr>';

				}
  
					echo'</table><br/><br/>';
			?>
				<?php 
					echo exec('whoami'). '<br/>'; 
				?>
 
		</div>
	
		<?php
			mysql_close($db_server);
			echo "connection closed<br>";
			function get_post($var)
			{
				return mysql_real_escape_string($_POST[$var]);
			}
		?>
	</body>
</html>