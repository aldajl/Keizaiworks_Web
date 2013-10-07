<?php
/*
 Template Name: National Template
*/
include 'stockbyloc.php';
?>
<?php get_header(); ?>
<div id="container">
<div class="squareSepTop"><br></div>
<div id="left">
	
	<?php while(have_posts()): the_post() ?>
	
		<?php the_content();?>
		
	<?php endwhile;?>
	
	<?php getInfo("national");?>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>