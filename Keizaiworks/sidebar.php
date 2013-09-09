<div id="sidebar">
	<div class="top">
	</div>
	<div class="mid">
	<h2>Blog Post</h2>
	<ul>
	<?php while(have_posts()): the_post() ?>
			<li><a href="<?php the_permalink();?>"><?php the_title()?></a></li>
	<?php endwhile;?>
	</ul>
	<?php dynamic_sidebar("Right Sidebar")?>
	</div>
	<div class="bot">
	</div>

</div>
