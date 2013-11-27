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
	    $newquery="SELECT*FROM ".$row[1];
		$newresult=mysql_query($newquery)or die("DB access failed: ".mysql_error());
		$newrows=mysql_num_rows($newresult);
		//loop through the item to create individual page
		for ($m=0; $m < $newrows; $m++){
			$newrow = mysql_fetch_row($newresult);
			$newphp=$name."_".$m.".php";//cpu_0;cpu_1,etc..
			$fh=fopen($newphp,"w");
		$content='<?php 
			session_start(); 
			?><html>
			<head>
			<title>'.$name.'</title>
			</head>
			<body>
			<?php
			$name="'.$name.'";
			$itemName=\''.$newrow[1].'\';
			$price="'.$newrow[2].'";
			$itemNumber="'.$newrow[0].'";
			$array=array($itemName,$price,$itemNumber);
			if(isset($_POST[\'add\'])){
			if (!isset($_SESSION[\'info\'])) 
			{     
			$_SESSION[\'info\'] = array(); 
			}  
				$num=$_POST[\'select\'];
				//Item name, price, item number,quantity 
				array_push($array,$num);
				if(array_key_exists($name,$_SESSION[\'info\'])){
				//The array contains all the things in a category
					$newarray=$_SESSION[\'info\'][$name];
				    $many=count($newarray);
					//The thing to tell if there has same item
					$boolean=false;
					for($e=0;$e<$many;$e++){
					if($newarray[$e][2]===$itemNumber){
						$_SESSION[\'info\'][$name][$e][3]+=$num;
						$boolean=true;
						//print_r($_SESSION[\'info\']);
						break;
						}
					}
					if(!$boolean)
					{
						array_push($_SESSION[\'info\'][$name],$array);
						//print_r($_SESSION[\'info\']);
					}

				}
				else{
					$_SESSION[\'info\'][$name]=array($array);
				}
			
			}
			$array=array();
			if(isset($_POST[\'check\'])){
			if(!isset($_SESSION[\'user\'])){
			printf("<script>window.open(\'login.php\')</script>");
			}
			else{
			printf("<script>location.href=\'summary.php\'</script>");
			}
			}	 
		?>
		<div><IMG src="/images/'.$name.'/'.$newrow[0].'.jpg">
		</div>
		<div>
			<form method="post" action="'.$newphp.'">
			<table>
			<tr><td>Price</td><td>'.$newrow[2].'</td></tr>
			<tr><td>Item#</td><td>'.$newrow[0].'</td></tr>
			<tr><td>Item Name</td><td>'.$newrow[1].'</td></tr>
			<tr><td>Detail description</td><td>'.$newrow[4].'</td></tr>
			<tr><td>The quantity to buy</td><td><select name="select">
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			  <option value="5">5</option>
			</select>
			</td></tr>
			<a href="welcome.php">Return to Main Menu</a>
			</table>
			
			<table>
			<tr><input rowspan="2" type="submit" name="add" value="Add to Cart" /></tr>
			<tr><input rowspan="2" type="submit" name="check" value="Check Out" /><tr>
			</table>
			</form>
			</div>
			</body>
			</html>';
			
			fwrite($fh,$content);
			fclose($fh);
		}
	}
?>
