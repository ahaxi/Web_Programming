<?php
SESSION_START();
?>

<html>
<head>
<title>Summary Page</title>
<script type="text/javascript"> 
var NtotalPrice=0;
var totalNumber;
function initial(){
	var tag=document.getElementsByTagName("input");
	totalNumber=tag.length-2;
}
	var price;
 function check(contents,m,n,ori)
 {  	
			
 		var newquantity=Math.round(contents);
		var id="t"+n;

              var price=newquantity*m;
		var change=(newquantity-ori)*m;
		var newChange=change*1;	
		var newprice=Math.round(price*100);
              document.getElementById(n).innerHTML=newprice/100;
		document.getElementById(id).value=newquantity;
		
		if(document.getElementById(n).innerHTML=="NaN"){
					alert("please enter valid number!");
					document.getElementById(n).innerHTML=0;
				}

		for(var i=0;i<totalNumber;i++){
			var each=document.getElementById(i).innerHTML;
			var Neach=each*1;
			//alert(Neach);
			NtotalPrice+=Neach;
		}

		NtotalPrice=Math.round(NtotalPrice*100);

		document.getElementById("total").innerHTML=NtotalPrice/100;
		NtotalPrice=0;

				
				//document.getElementById("quantity").innerHTML=Math.round(contents);
				
          
 }

	
	var browserName=navigator.appName;
if (browserName=="Netscape")
{
function closeme()
{
window.open('','_parent','');
window.close();
}
}
else
{
if (browserName=="Microsoft Internet Explorer")
{
function closynoshowsme()
{
window.opener = "whocares";
window.close();
}
}
} 
	
</script> 
</head>
<body onload="initial()">
<form name=f1 action="confirmation.php" method="POST"> 
<table cellpadding="2" cellspacing="2" border="2">
	<tr>
	<th>Catogory</th>
	<th>Item Description</th>
	<th>Item#</th>
	<th>Quantity in Cart</th>
	<th>Cost($)</th>
	</tr>

<?php
//print_r($_SESSION['info']);
$c=0;
$total=0;
	foreach($_SESSION['info'] as $a=>$b){
	//Item name, price, item number,quantity 
		echo "<tr><td>".$a."</td></tr><td colspan='4'></td></tr>";
		$nb=count($b);
		for($x=0;$x<$nb;$x++){
		echo "<tr><td></td><td>".$b[$x][0]."</td><td>".$b[$x][2].'</td><td align="right">';
		echo '<input type="text" name="quantity[]" id="t'.$c.'" onblur="check(this.value,'.$b[$x][1].','.$c.','.$b[$x][3].')" value="'.$b[$x][3].'"/>' ."</td>";
		echo '<td id="'.$c.'">'.$b[$x][1]* $b[$x][3].'</td></tr>';
		$c++;
		$total+=$b[$x][1]* $b[$x][3];
		}
	}
	echo '<tr><td colspan="3"></td><td>Total</td><td id="total" value="'.$total.'">'.$total.'</td></tr>';	

?>
<tr><td align="right"><input type="submit" name="confirm" value="Confirm" onclick="f1.action='confirmation.php'; return true;"/></td></tr>
</table>
</form>
<?php
if(isset($_POST['cancel'])){
//printf("<script>alert('hi');</script>");
session_destroy();
echo "hi";
}
?>
<form method="POST" action="summary.php">
<table>
<tr>
<td colspan="4" align="right"><input type="button" name="cancel" value="Cancel" onclick="closeme();"/></td>
</tr>
</table>
</form>

</body>
</html>
