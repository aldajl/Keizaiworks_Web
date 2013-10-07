<?php get_header(); ?>
<div id="container">

<div id="left">
	
	<?php while(have_posts()): the_post() ?>
	
		<h2><?php the_title()?></h2>
		<?php the_content();?>
		
	<?php endwhile;?>
	
	<?php comments_template('', true) ?>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>


