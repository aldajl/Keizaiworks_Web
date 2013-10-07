<?php
include 'keizaifunk.php';

function getInfo($stockLoc){
	switch($stockLoc){
		case "national":
			getNationalStocks();
			break;
		case "japan":
			getJapanStocks();
			break;
		case "united states":
			getNationalStocks();
			break;
		default:
			echo "<p>Could not find location, please log in</p>";
			break;
	}
}

function getJapanStocks(){
	$sLimit = 1;
	$conStock = getDBCon("1491219_stocks");
	$localData = getStockData($conStock, "stockName, stockOpen, stockHigh, stockLow, stockClose, stockChange", "tokyoStats", $sLimit);
	$localDati = array_fill(0, $sLimit, '');
	for($x=$sLimit-1; $x>=0; $x--){
		$localDati[$x]=$localData->fetch_array(MYSQLI_ASSOC);
	}
	
	echo '
	<table id="stockTable">
	<thead>
	<tr>
	<th>Stock Name</th>
	<th>Stock Open</th>
	<th>Stock High</th>
	<th>Stock Low</th>
	<th>Stock Close</th>
	<th>Stock Change</th>
	</tr>
	</thead>
	<tfoot>
	<td colspan="6">www.tse.or.jp</td>
	</tfoot>
	<tbody>
	';
	
	foreach ($localDati as $localInfos){
		echo "<tr>";
		foreach($localInfos as $localInfo){
			echo "<td>".$localInfo."</td>";
		}
		echo "</tr>";
	}
	
	echo '
	</tbody>
	</table>
	<br />
	<p style="font-size:xx-small;">News feed brought to you by: www.tse.or.jp</p>
	';
	getRSSFeed("www.tse.or.jp/english/news.rdf");
	echo '<br />';
}

function getNationalStocks(){
	$nasLimit = 9;
	$conStock = getDBCon("1491219_stocks");
	$nasDaqData = getNasDaqData($conStock, $nasLimit);
	$nasDaqDati = array_fill(0, $nasLimit, '');
	for($x=$nasLimit-1; $x>=0; $x--){
		$nasDaqDati[$x]=$nasDaqData->fetch_array(MYSQLI_ASSOC);
	}
	
	echo '
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
	<td colspan="5">www.nasdaq.com Last Updated On: '.$nasDaqDati[0]["timestamp"].'</td>
	</tfoot>
	<tbody>
	';
		
	foreach($nasDaqDati as $nasDaqi){
		echo "<tr><td>".$nasDaqi["stockName"]."</td><td>".$nasDaqi["stockStats"]."</td><td>".$nasDaqi["statDiff"]."</td><td>".$nasDaqi["beforeVal"]."</td><td>".$nasDaqi["afterVal"]."</td></tr>";
	}
	echo '
	</tbody>
	</table>
	<br />
	<p style="font-size:xx-small;">News feed brought to you by Nasdaq.com</p>
	';
	getRSSFeed("http://articlefeeds.nasdaq.com/nasdaq/categories?category=Stocks&format=xml");
	echo '<br />';
}
?>
