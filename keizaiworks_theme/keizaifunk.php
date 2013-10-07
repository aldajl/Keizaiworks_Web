<?php
function getDBCon($DB){
	$con=mysqli_connect("pdb7.awardspace.net",$DB,"As84267139",$DB);
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		return false;
	}
	else{
		return $con;
	}
}

function getCStat($con, $cur){
	$query = "SELECT cstats FROM ".$cur."cstats ORDER BY PID DESC LIMIT 1";
	$result = mysqli_query($con, $query) or die('Error, create query failed');
	$recentEntry = mysqli_fetch_array($result);
	return $recentEntry['cstats'];
}

function conversion($fromCStat, $toCStat){
	$from = 1;
	$to = ($toCStat/$fromCStat);
	if(empty($fromCStat)) {
		$fromCStat = 1;
	}
	if(empty($toCStat)) {
		$toCStat = 1;
	}
	echo "$from --- $to";
}

function getNasDaqData($conStock, $sLimit){
	$query = "SELECT stockName, stockStats, statDiff, statDiffPer, volume, beforeVal, afterVal, timestamp FROM nasdaqStats ORDER by PID DESC LIMIT ".$sLimit;
	$sendData = mysqli_query($conStock, $query) or die('Error, nasdaq query failed'.mysqli_error($conStock));
	return $sendData;
}

function getStockData($conStock, $qrySelect, $qryFrom, $sLimit){
	$query = "SELECT ".$qrySelect." FROM ".$qryFrom." ORDER by PID DESC LIMIT ".$sLimit;
	$sendData = mysqli_query($conStock, $query) or die('Error, '.mysqli_error($conStock));
	return $sendData;
}

function getRSSFeed($rssUrl){
	$rss = new DOMDocument();
	$rss->load($rssUrl);
	$feed = array();
	
	foreach($rss->getElementsByTagName('item') as $node){
		$item = array(
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
				'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
				);
		array_push($feed, $item);
	}
        
	$limit = 5;
	for($x=0;$x<$limit;$x++){
		$title = str_replace('&', '&amp', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
		echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		echo '<small><em>Posted on '.$date.'</em></small></p>';
		echo '<p>'.$description.'</p><br />';
	}
}
?>