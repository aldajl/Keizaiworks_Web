<?php
/*
 Template Name: Home Template
*/
include 'keizaifunk.php';
?>
<?php get_header(); ?>
<div id="container">
<div class="squareSepTop"><br></div>
<div id="left">
	
	<?php while(have_posts()): the_post() ?>
	
		<?php the_content();?>
		
	<?php endwhile;?>
	
	<br />
        <p style="font-size:xx-small;">News feed brought to you by: money.cnn.com</p>
	<?php getRSSFeed("http://rss.cnn.com/rss/money_latest.rss");?>
        <br />
<!--
    PeoplePerHour Profile Widget
    The div#pph-hire me is the element
    where the iframe will be inserted.
    You may move this element wherever
    you need to display the widget
-->
<div id="pph-hireme"></div>
<script type="text/javascript">
(function(d, s) {
    var useSSL = 'https:' == document.location.protocol;
    var js, where = d.getElementsByTagName(s)[0],
    js = d.createElement(s);
    js.src = (useSSL ? 'https:' : 'http:') +  '//www.peopleperhour.com/hire/2327794069/498493.js?width=300&height=255&orientation=vertical&theme=dark&hourlies=72712&rnd='+parseInt(Math.random()*10000, 10);
    try { where.parentNode.insertBefore(js, where); } catch (e) { if (typeof console !== 'undefined' && console.log && e.stack) { console.log(e.stack); } }
}(document, 'script'));
</script>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>