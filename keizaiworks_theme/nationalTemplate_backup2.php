<?php
/*
 Template Name: National Template
*/
include 'keizaifunk.php';
$nasLimit = 9;
$conStock = getDBCon("1491219_stocks");
$nasDaqData = getNasDaqData($conStock, $nasLimit);
$nasDaqDati = array_fill(0, $nasLimit, '');
for($x=$nasLimit-1; $x>=0; $x--){
	$nasDaqDati[$x]=$nasDaqData->fetch_array(MYSQLI_ASSOC);
}
?>
<?php get_header(); ?>
<div id="container">
<div class="squareSepTop"><br></div>
<div id="left">
	
	<?php while(have_posts()): the_post() ?>
	
		<?php the_content();?>
		
	<?php endwhile;?>
	
	<table id="stockTable">
		<thead>
			<tr>
				<th>Stock Name</th>
                                <th>Quote</th>
                                <th>Difference</th>
                                <th>Before Value</th>
                                <th>After Value</th>
			</tr>
		</thead>
                <tfoot>
                        <td colspan="0">www.nasdaq.com Last Updated On: <?php echo $nasDaqDati[0]["timestamp"];?></td>
                </tfoot>
		<tbody>
                        <?php
                        foreach($nasDaqDati as $nasDaqi){
                                echo "<tr><td>".$nasDaqi["stockName"]."</td><td>".$nasDaqi["stockStats"]."</td><td>".$nasDaqi["statDiff"]."</td><td>".$nasDaqi["beforeVal"]."</td><td>".$nasDaqi["afterVal"]."</td></tr>";
			}?>
		</tbody>
	</table>
	<br />
        <p style="font-size:xx-small;">News feed brought to you by Nasdaq.com</p>
	<?php getRSSFeed("http://articlefeeds.nasdaq.com/nasdaq/categories?category=Stocks&format=xml");?>
        <br />
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>