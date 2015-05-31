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
    <title>Verification Ajout Terminal</title>
  </head>
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Validation de l'ajout d'un terminal</h1>
		</div>
	<?php
	$numSerie=$_POST['numSerie'];
	$modele=$_POST['modele'];
	if(empty($numSerie) || empty($modele)){
		header('Location: ajout-terminal-erreur.php');
		exit();
	}
	
	
	include("connect.php");
	$vConn=fConnect();
	
	$sql1="select id from modele where designation='$modele'";
	$req=pg_query($vConn, $sql1);
	if($res=pg_fetch_array($req, null, PGSQL_ASSOC))
	{
		$vSql="INSERT INTO Terminal(numero_serie,modele,proprietaire) VALUES ('$numSerie',".$res['id'].",".$_SESSION['id'].")";
		$vQuery=pg_query($vConn,$vSql);
	}
	?>
	
	<h2> L'ajout de terminal a été pris en compte</h2>
		<!-- insert une ligne horizontal --> <hr>
	<p><a href="terminaux.php"> Retour aux terminaux </a></p>
	</div>
  </body>
</html>