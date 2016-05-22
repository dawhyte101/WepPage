 <html>
	<head>
		<title>HW05 PHP  CS340 Spring 2015   Dustin Whyte</title>
	</head>
	<a href="..\hw01\hw01.php">HW01</a>
	<a href="..\hw02\hw02.php">HW02</a> 
	<a href="..\hw03\Hw03.php">HW03</a> 
	<a href="..\hw04\hw04.php">HW04</a> 
	<a href="Hw05.php">HW05</a> 
	<a href ="..\Hw07\Hw07.php">HW07</a>
	<a href ="..\hw07\Hw07 update.php">HW07 update</a>
	<a href="..\Midterm\CS340Midterm.php">Midterm</a>
	<?php
	require_once 'logon.php';
	$conn = new mysqli($hostname, $username, $password, $database);
	if ($conn->connect_error) die($conn->connect_error);
	if (isset($_POST['delete']) && isset($_POST['name']))
		{
			$name = get_post($conn, 'name');
			$query = "DELETE FROM cars WHERE Name='$name'";
			$result = $conn->query($query);
			if (!$result) echo "DELETE failed: $query<br>" .
			$conn->error . "<br><br>";
			else echo 'delete successful <br>';
		}
		if (isset($_POST['name']) &&
		isset($_POST['color']) &&
		isset($_POST['owner']) &&
		isset($_POST['miles']) &&
		isset($_POST['year']))
		{
			$name = get_post($conn, 'name');
			$color = get_post($conn, 'color');
			$owner = get_post($conn, 'owner');
			$miles = get_post($conn, 'miles');
			$year = get_post($conn, 'year');
			$query = "INSERT INTO cars VALUES" .
			"('$name', '$color', '$owner', '$miles', '$year')";
			$result = $conn->query($query);
			if (!$result) echo "INSERT failed: $query<br>" .
			$conn->error . "<br><br>";
		}
	echo <<<_END
	<form action="Hw05.php" method="post"><pre>
	Name <input type="text" name="name">
	Color <input type="text" name="color">
	Owner <input type="text" name="owner">
	Miles <input type="text" name="miles">
	Year <input type="text" name="year">
	<input type="submit" value="ADD RECORD">
	</pre></form>
_END;
	$query = "SELECT * FROM cars";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	for ($j = 0 ; $j < $rows ; ++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo <<<_END
		<pre>
		Name $row[0]
		Color $row[1]
		Owner $row[2]
		Miles $row[3]
		Year $row[4]
		</pre>
		<form action="Hw05.php" method="post">
		<input type="hidden" name="delete" value="yes">
		<input type="hidden" name="name" value="$row[0]">
		<input type="submit" value="DELETE RECORD">
		</form>
_END;
	}
	$result->close();
	$conn->close();
	function get_post($conn, $var)
	{
		return $conn->real_escape_string($_POST[$var]);
	}
	?>
</html>