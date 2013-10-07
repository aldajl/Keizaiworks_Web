<?php
	session_start();
?>
<?php 
        
	require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
	$con=mysqli_connect("pdb7.awardspace.net","1491219_accnts","As84267139","1491219_accnts");
	$registered=false;
        $userFound = false;
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if(isset($_POST['registered'])){
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
		
                if(preg_match('%^[A-Za-z]\S{3,20}$%',stripslashes(trim($_POST['country'])))){
			$c=$_POST['country'];
		} else {
			$c=false;
			echo '<p><font colot="red" size="+1">Please enter a valid country!</font></p>';
		}
                if($u && $p && $c){
                        $checkQuery="SELECT userid FROM regAccounts WHERE userid='$u'";
                        $checkResult=mysqli_query($con, $checkQuery);
                        
                        if($checkResult && mysqli_num_rows($checkResult) > 0){
                                $userFound = true;
                        }
                        
                        else{
                                $query = "INSERT INTO regAccounts (userid, pass, country, permission) VALUES ('$u', '$p', '$c', '0')";
                                $result = mysqli_query($con, $query) or die("Either the Userid or Password is incorrect");
                                $registered=true;
                        }
                        
                        mysqli_close($con);
                }
        }
?>
<?php get_header(); ?>
<div id="container">
<div class="squareSepTop"><br></div>
<div id="left">
	<?php 
		if(isset($_SESSION['userid'])){
			echo "<p>You can not create a new account while logged in. Please log out and try again</p>";
		} 
		
		elseif($registered){
			echo "<p>Register was successful!</p>";
		} 
                
                elseif($userFound){
                        echo "<p>Username has already be taken, please try again</p>";
                        echo '<form name="register" action="register.php" method="post">
                   Username:<input type="text" name="userid">
                   Password:<input type="password" name="pass">
                   Country:<input type="text" name="country">
                   <button type="submit" name="submit" >register</button>
                   <input type="hidden" name="registered" value="true">
                   </form>';
                }
                else {
			echo '<form name="register" action="register.php" method="post">
                   Username:<input type="text" name="userid">
                   Password:<input type="password" name="pass">
                   Country:<input type="text" name="country">
                   <button type="submit" name="submit" >register</button>
                   <input type="hidden" name="registered" value="true">
                   </form>';
		}
	?>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>