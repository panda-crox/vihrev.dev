<?php
	mysql_connect('localhost', 'root', '') or die('No connect');
	mysql_select_db('vihrev');
	mysql_query("SET CHARSET utf8");


	require_once('classes.php');
	$vihrev = new Vihrev();


	if (!$vihrev->checkUrl($vihrev->nav)) {
		$vihrev->get404();
	}


	$func = $vihrev->getModule($vihrev->nav);

	$vihrev->$func();
?>