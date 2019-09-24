<?php
header('content-type: text/xml; charset=utf-8');
include_once('../lib/config.php');
include_once('../lib/db.php');
$cn = connect($host, $user, $pwd, $db);

$sql = "select * from {$pre}article limit 4";
$data = getAll( $sql);

$string = <<<XML
<?xml version="1.0" encoding="utf-8" ?>
	<article></article>
XML;
$xml = new SimpleXMLElement($string);
foreach($data as $key=>$value) {
	$setion = $xml->addChild('setion');
	foreach($value as $k=>$v) {
		$setion->addAttribute($k, $v);
	}
}
echo $xml->asXML();
// $xml->asXML('test.xml');





