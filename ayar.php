<?php

	$serverName = "localhost";//192.168...
	$userName = "root";
	$sifre = "";
	$dbName = "android";

	$baglan = mysqli_connect($serverName, $userName, $sifre, $dbName);
	mysqli_set_charset($baglan, "UTF-8");
	mysqli_query($baglan, "SET NAMES UTF8");

?>