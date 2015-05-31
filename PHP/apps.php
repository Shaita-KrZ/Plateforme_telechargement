<?php
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Applications compatibles</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Liste des applications compatibles</h1>
		</div>
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th>Nom de l'application</th>
					<th>Prix</th>
					<th>Editeur</th>
					<th>Description</th>
				</tr>
				<?php
				include('connect.php');
				$db = fConnect();
				
				$sql = "SELECT DISTINCT AD.app as Application, a.prix as prix, E.nom as editeur, a.description as description
					FROM application a, Terminal T, Modele M, OS, Application_disponible_pour AD, Utilisateur U, editeur E
					WHERE E.id = a.editeur
					AND a.nom = ad.app
					AND T.modele = M.id
					AND M.systeme = OS.id
					AND AD.systeme = OS.id
					AND U.idClient = T.proprietaire
					AND U.idClient = ".$_SESSION['id'];
				$req = pg_query($db, $sql);
				
				

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					
					echo('<tr>');
					echo('<td>' . $res['application'] . '</td>');
					echo('<td>' . round($res['prix'],2) . '€</td>');
					echo('<td>' . $res['editeur'] . '</td>');
					echo('<td>' . $res['description'] . '</td>');
					echo('</tr>');
				}
				
				?>
			</table>
		</div>
		<a href="menu_user.php">Retour</a>
	</div>
  </body>
</html>
