<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Verification Inscription</title>
  </head>
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Validation de l'inscription</h1>
		</div>
	<?php
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$terminal=$_POST['terminal'];
	$modele=$_POST['modele'];
	
	include("connect.php");
	$vConn=fConnect();
	if(empty($nom) || empty($prenom) || empty($terminal) || empty($modele)){
		header('Location: inscription-erreur.php');
		exit();
	}
	$vSql="SELECT * FROM Utilisateur where nom='$nom'";
	$vQuery=pg_query($vConn,$vSql);
	if($vResult=pg_fetch_array($vQuery)){
		header('Location: inscription-erreur.php');
		exit();
	}
	
	$vSql="SELECT * FROM Terminal where numero_serie='$terminal'";
	$vQuery=pg_query($vConn,$vSql);
	if($vResult=pg_fetch_array($vQuery)){
		header('Location: inscription-erreur.php');
		exit();
	}
	
	$vSql="SELECT * FROM Modele where id='$modele'";
	$vQuery=pg_query($vConn,$vSql);
	if(!$vResult=pg_fetch_array($vQuery)){
		header('Location: inscription-erreur.php');
		exit();
	}
	
	
	$vSql="INSERT INTO Utilisateur(idClient,nom, prenom) VALUES (DEFAULT,'$nom','$prenom') RETURNING idClient as id;"; 
	$vQuery=pg_query($vConn,$vSql);
	$vResult=pg_fetch_array($vQuery);
	$vSql="INSERT INTO Terminal(numero_serie,modele,proprietaire) VALUES ('$terminal','$modele',$vResult[id]);";
	$vQuery=pg_query($vConn,$vSql);
	?>
	
	<h2> Votre inscription a bien été pris en compte</h2>
		<!-- insert une ligne horizontal --> <hr>
	<p><a href="index.php"> Retour pour identification </a></p>
	</div>
  </body>
</html>