<?php
	session_start();
	session_destroy();
?>
<?php 
	require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
?>
<?php get_header(); ?>
<div id="container">
<div class="squareSepTop"><br></div>
<div id="left">
	<p>Successfully Logged Out</p>
	<br>
	<p><a href="http://keizaiworks.mypressonline.com">Click here to return to index</a></p>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>