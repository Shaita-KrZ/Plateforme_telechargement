<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Utilisateurs les plus actifs</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Liste des utilisateurs les plus actifs</h1>
		</div>
		<div class="panel-default panel">
			<table class="table">
				<tr>
					<td>Nom</td>
					<td>Prénom</td>
					<td>Nombre d'avis</td>
				</tr>
				<?php
				include('connect.php');
				$db = fConnect();
				
				$sql = "SELECT U.nom AS nom, U.prenom AS prenom, COUNT(A.app) AS nbAvis
					FROM Utilisateur U, Avis A
					WHERE U.idClient = A.client
					GROUP BY U.nom, U.prenom
					ORDER BY nbAvis";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					echo('<td>' . $res['nom'] . '</td>');
					echo('<td>' . $res['prenom'] . '</td>');
					echo('<td>' . $res['nbavis'] . '</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>
		<a href="menu_analyst.php">Retour</a>
	</div>
  </body>
</html>
