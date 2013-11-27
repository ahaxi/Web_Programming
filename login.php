<?php 
session_start(); 
$_SESSION['user']="Hi";
?>
<html>
    <head>
        <title>Login</title>
        <style type="text/css">
            div {
                width: 30%;
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
    <div>
<?php
if(isset($_POST['login'])){
	$name=$_POST['username'];
	$passwd=$_POST['passwd'];
		$db_server = mysql_connect('localhost') or die('Unable to open DB connection');
		$dbname = 'test';
		mysql_select_db($dbname) or die("Unable to access database".$dbname);
		$query = "SELECT*FROM xieg_useraccount";
		$result = mysql_query($query) or die("DB access failed: ".mysql_error());
		$rows = mysql_num_rows($result); 
		$boolean=false;
		for ($i=0; $i < $rows; $i++){
			$row = mysql_fetch_row($result);
			if($row[1]===$name){
				if($row[2]===$passwd){
				$boolean=true;
				break;
				}
			}
		}
		if($boolean){
			$_SESSION['user']=$name;
			printf("<script>location.href='welcome.php'</script>");
		}
		else{
			echo "You username and password is not correct.";
		}
		mysql_close($db_server);
	}
?>	
    <form method="post" action="login.php">
    <fieldset>
        <legend>Login</legend>
        <!-- Your HTML goes here -->
		<table cellspacing="10px">
		<tr>
		<td><label>Username:</label></td>
		<td><input type="text" name="username"></input></td>
		</tr>
		<tr>
		<td><label>Password:</label></td>
		<td><input type="password" name="passwd"></input></td>
		</tr>
		<tr>
		<td colspan="2" align="center">
		<input type="button" value="Cancel" id="cancel" />
		<input type="submit" value="Login" name="login" /></td>
		</tr>
		</table>
		<table width="100%">
		<tr>
		<td align="center">
		<a href="register.php">register</a>
		</td>
		</tr>
		</table>

    </fieldset>
	</form>
    </div>
    </body>
</html>
