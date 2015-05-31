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
    <title>Verification Ajout Application</title>
  </head>
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Validation de l'ajout d'une application</h1>
		</div>
	<?php
	$nom=$_POST['nom'];
	$editeur=$_POST['editeur'];
	$description=$_POST['description'];
	$prix=$_POST['prix'];
	$os=$_POST['OS'];
	if(empty($nom) || empty($editeur) || empty($description) || empty($os)){
		header('Location: ajout-app-erreur.php');
		exit();
	}
	include('connect.php');
	$db=fConnect();
	$sql1="select id from editeur where nom='$editeur'";
	$req1=pg_query($db, $sql1);
	if($res1=pg_fetch_array($req1, null, PGSQL_ASSOC))
	{
		$sql2="insert into application(nom, editeur, description, prix) values ('$nom',".$res1['id'].", '$description', $prix)";
		$req2=pg_query($db, $sql2);
		
		$sql3="select id from OS where version='".$os."'";
		$req3=pg_query($db, $sql3);
		if($res3=pg_fetch_array($req3, null, PGSQL_ASSOC))
		{
			$sql4="insert into application_disponible_pour values ('$nom',".$res3['id'].")";
			$req4=pg_query($db, $sql4);
		}	
	}
	?>
	
	<h2> L'ajout de l'application a été pris en compte</h2>
		<!-- insert une ligne horizontal --> <hr>
	<p><a href="menu_admin.php"> Retour au menu administrateur </a></p>
	</div>
  </body>
</html>