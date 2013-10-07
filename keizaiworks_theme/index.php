<?php get_header(); ?>
<div id="container">

<div id="left">
	<div class="squareSepTop"><br></div>
	
	
	<?php while(have_posts()): the_post() ?>
	
		<h2><a href="<?php the_permalink();?>"><?php the_title()?></a></h2>
		<p>
			by: <?php echo get_the_author_link();?>
		</p>
		<?php the_content(__('Continue Reading'));?>
		
	<?php endwhile;?>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

