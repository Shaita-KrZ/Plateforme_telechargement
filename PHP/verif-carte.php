<?php
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Verification Accord Carte</title>
  </head>
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Validation de l'accord d'une carte prepayee</h1>
		</div>
	<?php
	date_default_timezone_set('Europe/Paris');
	$dateExpi=$_POST['dateExpi'];
	$montant=$_POST['montant'];
	$client=$_POST['client'];
	
	// date à tester : 
	$now = date('Y-m-d'); 

	// test 
	$now = new DateTime( $now ); 
	$now = $now->format('Ymd'); 
	$dateExpi = new DateTime( $dateExpi); 
	$dateExpi = $dateExpi->format('Ymd'); 

	if($dateExpi < $now){
		header('Location: accord-carte-erreur.php');
		exit();
	}
	if(empty($dateExpi) || empty($montant) || empty($client)){
		header('Location: accord-carte-erreur.php');
		exit();
	}
	include('connect.php');
	$db=fConnect();
	$sql1="select CAST(numero as INT) as numcarte from cartePrepayee where CAST(numero as INT) >=ALL(select CAST(numero as INT) from cartePrepayee)";
	$req1=pg_query($db, $sql1);
	if($res1=pg_fetch_array($req1, null, PGSQL_ASSOC))
	{
		$sql2="select idclient from utilisateur where login='$client'";
		$req2=pg_query($db, $sql2);
		if($res2=pg_fetch_array($req2, null, PGSQL_ASSOC))
		{
			$num=$res1['numcarte']+1;
			$sql3="insert into cartePrepayee values ('$num', '$dateExpi', $montant, $montant, ".$res2['idclient'].")";
			$req3=pg_query($db, $sql3);
		}
	}
	
	?>
	
	<h2> L'ajout de la carte a été pris en compte</h2>
		<!-- insert une ligne horizontal --> <hr>
	<p><a href="menu_admin.php"> Retour au menu administrateur </a></p>
	</div>
  </body>
</html>