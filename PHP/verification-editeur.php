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
    <title>Verification Ajout Editeur</title>
  </head>
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Validation de l'ajout d'un editeur</h1>
		</div>
	<?php
	$nom=$_POST['nom'];
	$contact=$_POST['contact'];
	$url=$_POST['url'];
	if(empty($nom) || empty($contact) || empty($url)){
		header('Location: ajout-editeur-erreur.php');
		exit();
	}
	include('connect.php');
	$db=fConnect();
	$sql="select id from editeur where id>=ALL(select id from editeur)";
	$req=pg_query($db, $sql);
	if($res=pg_fetch_array($req, null, PGSQL_ASSOC))
	{
		$id=$res['id']+1;
		$sql2="insert into editeur(id, nom, contact, url) values($id, '$nom', '$contact', '$url')";
		$req2=pg_query($db, $sql2);
	}
	?>
	
	<h2> L'ajout de l'editeur a été pris en compte</h2>
		<!-- insert une ligne horizontal --> <hr>
	<p><a href="menu_admin.php"> Retour au menu administrateur </a></p>
	</div>
  </body>
</html>