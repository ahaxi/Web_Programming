<?php
 $db_server = mysql_connect('localhost') or die('Unable to open DB connection');
 
 $dbname = 'test';
 mysql_select_db($dbname) or die("Unable to access database".$dbname);
 //Get all the tables contains the name of other tables
 $query = "SELECT*FROM xieg_tables";

 $result = mysql_query($query) or die("DB access failed: ".mysql_error());
 
 $rows = mysql_num_rows($result); 
 //loop through the name tables
 for ($i=0; $i < $rows; $i++)
     {
        $row = mysql_fetch_row($result);
		$name=substr($row[1],5);//cpu,memory,etc
		$newphp=$name.".php";//cpu,etc..
		$fh=fopen($newphp,"w");
		$content='
			<html>
			<head>
			<title>Display Page</title>
			<style type="text/css">
			</style>
			</head>
			<body>
			<h2>Inventory:</h2> 
			<table cellpadding="2" cellspacing="2" border="2">
			<tr>
			<th>Item Description</th>
			<th>Item#</th>
			<th>Cost</th>
			</tr>

			<?php 

			$db_server = mysql_connect(\'localhost\') or die(\'Unable to open DB connection\');
 
			$dbname = \'test\';
			mysql_select_db($dbname) or die("Unable to access database".$dbname);
			//Get all the tables contains the name of other tables
			$nameC="'.$name.'";
			$query = "SELECT*FROM xieg_".$nameC;

			$result = mysql_query($query) or die("DB access failed: ".mysql_error());
 
			$rows = mysql_num_rows($result); 
			//loop through the name tables
			for ($i=0; $i < $rows; $i++)
			{
				$row = mysql_fetch_row($result);
				echo \'<tr><td><a href="\'.$nameC."_".$i.\'.php">\'.$row[1]."</a></td><td>".$row[0].\'</td><td align="right">\';
				echo $row[2]."</td></tr>";
			}

  
			mysql_close($db_server);
 
			?>
		<a href="welcome.php">Return to Homepage</a>
		</table>
		</form>
		</body>
		</html>';
		fwrite($fh,$content);
		fclose($fh);			
	}
?>
