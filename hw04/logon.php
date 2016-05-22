	<?php
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database='cars';

		try 
		{
			$db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
			echo "Connected to database     $database   <br/>";
		}
		catch(PDOException $e) 
		{
			echo $e->getMessage();
		}
		$db_server = mysql_connect($hostname,$username,$password);
	?>