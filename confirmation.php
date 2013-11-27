<?php
SESSION_START();
?>

<html>
<head>
<title>Confirm Page</title>
</head>
<body>
<table cellpadding="2" cellspacing="2" border="2">
	<tr>
	<th>Catogory</th>
	<th>Item Description</th>
	<th>Item#</th>
	<th>Quantity in Cart</th>
	<th>Cost</th>
	</tr>

<?php
	if(isset($_POST['confirm'])){
	$newarray=$_POST['quantity'];
	$count=count($newarray);
	$countForArray=0;
	//if string don't change the value
	foreach($_SESSION['info'] as $a=>$b){
		
		$nb=count($b);
		$valid=count($b);
		for($x=0;$x<$nb;$x++){
			
			/*The logic to judge a string and 0:
			
			'a string' == true equates to true because PHP will evaluate any non empty string to true if compared with a boolean.

			0 == false equates to true because the integer 0 is evaluated as false when compared with a boolean.

			'a string' == 0 also evaluates to true because any string is converted into an integer when compared with an integer.

			*/
			
			//If it is an zero or null
			if(($newarray[$countForArray]==false&&!($newarray[$countForArray]==true))||$newarray[$countForArray]==null){
				--$valid;
				unset($_SESSION['info'][$a][$x]);
			}
			//If it is a string
			else if($newarray[$countForArray]==0&&$newarray[$countForArray]==true){
				unset($_SESSION['info'][$a][$x]);
			}
			else{
				$_SESSION['info'][$a][$x][3]=$newarray[$countForArray];
			}
			$countForArray++;
		}
		if($valid===0){
			unset($_SESSION['info'][$a]);
		}
		else{
			$_SESSION['info'][$a]=array_values($_SESSION['info'][$a]);
		}
	}

	$totalCost = 0;

	foreach($_SESSION['info'] as $a=>$b){
		echo "<tr><td>".$a."</td></tr><td colspan='4'></td></tr>";
		$nb=count($b);
		for($x=0;$x<$nb;$x++){
		echo "<tr><td></td><td>".$b[$x][0]."</td><td>".$b[$x][2].'</td><td align="right">'.$b[$x][3]."</td>";
		echo '<td>'.$b[$x][1]* $b[$x][3].'</td></tr>';
		$totalCost += $b[$x][1]* $b[$x][3];
		}
	}
		echo "<tr><td colspan='4' align='right'>Total: </td><td>".$totalCost."</td></tr>";
		
				echo '<script language = "javascript" type="text/javascript">';
			    echo 'alert("Thank you!")';
			    echo '</script>';
}




?>

</table>
</form>
</body>
</html>
