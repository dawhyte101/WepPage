<html>
 <head>
  <title>HW02  CS340 Spring 2015   Dustin Whyte</title>
 </head>
<a href="..\hw01\hw01.php">HW01</a>
<a href="hw02.php">HW02</a>
<a href="..\hw03\Hw03.php">HW03</a>
<a href="..\hw04\hw04.php">HW04</a>
<a href="..\Hw05\Hw05.php">HW05</a>
<a href ="..\Hw07\Hw07.php">HW07</a>
<a href ="..\hw07\Hw07 update.php">HW07 update</a>
<a href="..\Midterm\CS340Midterm.php">Midterm</a>
 <body>
	<?php
		echo exec('whoami'). '<p>HW02 CS340 Spring 2014 Dustin Whyte</p> <br/>';
		echo date("l, F, jS");
		echo '<br/>';  ?>

		<?php echo '<p><h2>Part 2</h2></p>';

			class Cars
			{
				public $name, $color, $owner, $miles, $year;
				public function __construct($name, $color, $owner, $miles, $year)
				{
					$this->name=$name;
					$this->color=$color;
					$this->owner=$owner;
					$this->miles=$miles;
					$this->year=$year;
				}
			}
			$fh = fopen("input.txt", 'r') or die ("Error");
			$fo = fopen("output.txt", 'w') or die ("failed to create out file");

			$line=(String)date("l, F, jS").' CS340 Dustin Whyte HW02'.PHP_EOL;

			fwrite($fo,$line) or   die("Could not write date to outfile");

			echo'<table>
			<tr>
				<th>Name</th>
				<th>Color</th>
				<th>Owner</th>
				<th>Miles</th>
				<th>Year</th>
			</tr>';

				for ($j=0; $j<5;++$j)
				{				
					$line=fgets($fh);
					echo'<tr><td>';
					//echo($line).'<br/>';
					$temp = explode(';',$line);
					// print_r($temp);
					$object1 = new Cars ($temp[0],$temp[1],$temp[2],$temp[3],$temp[4]);
					//$object1->first=$temp[0];
					//print_r($object1);
					echo $object1->name.'</td><td>'.$object1->color.'</td><td>'.$object1->owner.'</td><td>'.$object1->miles.'</td><td>'.$object1->year.'</td>';
					$objectarray[]=$object1;
					echo'</tr>';
					fwrite($fo,$line) or die("Could not write to outfile");
				}

				echo'</table>';

				fclose($fh);
				fclose($fo);
				echo '<p><h2>Writing a text file</h2></p>';
				/*for ($j=0; $j<5;++$j)
				{
				fwrite($fo,$objectarray[$j]) or die("Could not write to outfile");}*/

				echo "File 'Hw01out.txt' written successfully";
		?>
 </body>
</html>
