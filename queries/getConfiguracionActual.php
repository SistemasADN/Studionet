<?php
	include_once "dbcon.php";
	$cobranzaDefault = select_query_one($con, "SELECT idForma FROM formacobranzadefault", '', []);
?>
