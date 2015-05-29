<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Meilleurs éditeurs</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Liste des meilleurs éditeurs</h1>
		</div>
		<h1>Liste des éditeurs avec le plus gros chiffre d'affaire</h1>
		<div>
			<table>
				<th>
					<td>Nom de l'éditeur</td>
					<td>Chiffre d'affaire</td>
				</th>
				<?php
				include('connect.php');
				$db = fConnect();
				
				$sql = "";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					echo('<td>$res[]</td>');
					echo('<td>$res[]</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>

		<h1>Liste des éditeurs avec le plus de ventes</h1>
		<div>
			<table>
				<th>
					<td>Nom de l'éditeur</td>
					<td>Nombre de ventes</td>
				</th>
				<?php
				include('connect.php');
				$db = fConnect();
				
				$sql = "";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					echo('<td>$res[]</td>');
					echo('<td>$res[]</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>
		<a href="menu_analyst.php">Retour</a>
	</div>
  </body>
</html>