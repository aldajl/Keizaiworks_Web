<?php
session_start(); 
?>
<?php 

$con=mysqli_connect("pdb7.awardspace.net","1491219_accnts","As84267139","1491219_accnts");
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($_POST['submitted'])){
	if(preg_match('%^[A-Za-z0-9]\S{4,20}$%',stripslashes(trim($_POST['userid'])))){
		$u=$_POST['userid'];
	} else {
		$u=false;
		echo '<p><font colot="red" size="+1">Please enter a valid User ID!</font></p>';
	}
	
if(preg_match('%^[A-Za-z0-9]\S{8,20}$%',stripslashes(trim($_POST['pass'])))){
		$p=$_POST['pass'];
	} else {
		$p=false;
		echo '<p><font colot="red" size="+1">Please enter a valid Password!</font></p>';
	}
	
if($u && $p){
	$query = "SELECT userid, pass, country, permission FROM regAccounts WHERE userid='$u' && pass='$p'";
	$result = mysqli_query($con, $query) or die("Either the Userid or Password is incorrect");
	if(mysqli_affected_rows($con)==1){
		$row = mysqli_fetch_array($result, MYSQL_NUM);
		mysqli_free_result($result);
		$_SESSION['userid']=$row[0];
		$_SESSION['country']=$row[2];
		$_SESSION['permission']=$row[3];
		header("Location: http://keizaiworks.mypressonline.com");
		mysqli_close($con);
		exit();
	} else {
		mysqli_close($con);
		exit();
	}
	}
}
?>
<!doctype html>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<html>
        <body>
        </body>
</html>