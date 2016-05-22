	<?php
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$db_database='cars';

		try 
		{
			$db = new PDO("mysql:host=$hostname;dbname=$db_database", $username, $password);
			echo "Connected to database     $db_database   <br/>";
		}
		catch(PDOException $e) 
		{
			echo $e->getMessage();
		}
		$db_server = mysql_connect($hostname,$username,$password);
	?>