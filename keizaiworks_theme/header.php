<?php
        session_start();
?>
<!doctype html>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<html>
<head>
	<meta charset ="utf-8" />
	<title><?php bloginfo('title')?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url')?>" />
	<style type="text/css">
		header{
			background: url("<?php bloginfo('template_directory'); ?>/images/keizaiworks_header_background_beg.png") left no-repeat,
						url("<?php bloginfo('template_directory'); ?>/images/keizaiworks_header_background_end.png") right no-repeat, 
						url("<?php bloginfo('template_directory'); ?>/images/keizaiworks_header_background.png");		
		}
		nav{
			background-image: url("<?php bloginfo('template_directory'); ?>/images/navbar_mid.png");
			background-repeat: repeat-x;
		}
		nav li:after{
			content: url("<?php bloginfo('template_directory'); ?>/images/dot_sep.png");
		}
		#sidebar div.top{
			padding:2px;
			background:url("<?php bloginfo('template_directory'); ?>/images/sidebar_background.png") no-repeat;
		}
		#sidebar div.mid{
			padding:20px;
			background:url("<?php bloginfo('template_directory'); ?>/images/sidebar_background_mid.png") repeat-y;
		}
		#sidebar div.bot{
			padding:15px;
			background:url("<?php bloginfo('template_directory'); ?>/images/sidebar_background_end.png") no-repeat;
		}
		.squareSepTop{
			background:url("<?php bloginfo('template_directory'); ?>/images/square_sep.png") top repeat-x;
			width: 70%;
		}
		#left{
			background:url("<?php bloginfo('template_directory'); ?>/images/main_background.png");
		}
	</style>
</head>

<header>
	<a href="<?php echo home_url('/')?>"><img src="<?php bloginfo('template_directory'); ?>/images/keizaiworks_banner.png" alt="Keizai Works" width="25%" height="100%"/></a>
        <?php
                if(isset($_SESSION['userid'])){
			echo '<div id="logout"><form name="logout" action="/logout.php" method="post">
			      '.$_SESSION['userid'].'
			      <button type="submit" name="submit">Log Out</button>
			      </form></div>';
                } else {
                        echo '<div id="login"><form name="login" action="/login.php" method="post">
                              Username:<input type="text" name="userid">
                              Password:<input type="password" name="pass">
                              <button type="submit" name="submit" >Log in</button>
                              <input type="hidden" name="submitted" value="true"/>
                              </form></div>';
                }
        ?>
	
</header>

<nav>
	<?php wp_nav_menu()?>
</nav>
<body>