<?php

require_once(dirname(__FILE__) . '/utils.php');

$debug = true;
$debug = false;

$container = 'American Midland Naturalist';
$container = 'Annals of Botany. Oxford';
$container = 'Arctoa';
$container = 'Phytotaxa';

$sql = 'SELECT * FROM `references` WHERE containerTitle="' . $container . '"';

$sql = 'SELECT * FROM `references`';


$data = do_query($sql);

if ($debug)
{
	print_r($data);
}

$count = 1;

foreach ($data as $item)
{
	$doc = new stdclass;
	$doc->q = $item->citation;
	
	echo "-- " . $item->citation . "\n";
	
	$url = 'http://localhost/citation-matching/api/crossref.php';

	$json = post($url, json_encode($doc));

	if ($debug)
	{
		echo $json . "\n";
	}

	$doc = json_decode($json);
	
	//print_r($doc);
	
	if (isset($doc->DOI))
	{
		echo 'UPDATE `references` SET doi="' . $doc->DOI . '" WHERE ID="' . $item->ID . '";' . "\n";
	}
	

	// Give server a break every 10 items
	if (($count++ % 10) == 0)
	{
		$rand = rand(1000000, 3000000);
		echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
		usleep($rand);
	}

}

?>

