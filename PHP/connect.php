<?php
	function fConnect(){
		$vHost="tuxa.sme.utc";
		$vPort="5432";
		$vDbname="dbnf17p105";
		$vUser="nf17p105";
		$vPassword="JEzs9uXe";
		$vConn=pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
		return $vConn;
	}
	?>
