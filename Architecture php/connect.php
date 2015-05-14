<?php
	function fConnect(){
		$vHost="tuxa.sme.utc";
		$vPort="5432";
		$vDbname="dbnf17p106";
		$vUser="nf17p106";
		$vPassword="AX8YLzbj";
		$vConn=pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
		return $vConn;
	}
	?>