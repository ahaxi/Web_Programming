<?php 
session_start(); 
?>
<html>
 <head>
 <title>Welcome</title>
 <style type="text/css"></style>
 </head>
 <body>
 <h2>Welcome <?php echo $_SESSION['user'];?></h2>
 <h2>All categories:</h2> 
 <form name="Submit" action="summary.php" method="POST"> 
 <table cellpadding="2" cellspacing="2" border="2">
	<tr>
	<th>Catogory</th>
	</tr>
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
		$name=substr($row[1],5);
		echo '<tr><td><a href="'.$name.'.php">'.$name.'</a></td></tr>';
	}
 mysql_close($db_server);
 ?>
</table>
</form>
<a href="login.php">login</a>
<a href="summary.php">check out</a>
</body>
</html>
