<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Meilleurs applications et ressources</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Liste des installations par contenu</h1>
		</div>
		<div class="panel-default panel">
			<table class="table">
				<tr>
					<td>Nom du contenu</td>
					<td>Type</td>
					<td>Nombre d'installation</td>
				</tr>
				<?php
				include('connect.php');
				$db = fConnect();
				$sql = "SELECT PAch.res AS res, PAch.app AS app, COUNT(inst.terminal) AS nbInstallation 
					FROM Produitachete PAch 
					LEFT OUTER JOIN Installe_sur inst
					ON PAch.id = inst.produit
					GROUP BY PAch.res, PAch.app
					ORDER BY nbInstallation DESC";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					if($res['res'] != "")
					{
						echo('<td>' . $res['res'] . '</td>');
						echo('<td> Ressource </td>');
					}
					else
					{
						echo('<td>' . $res['app'] . '</td>');
						echo('<td> Application </td>');
					}
					echo('<td>' . $res['nbinstallation'] . '</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>
		<a href="menu_analyst.php">Retour</a>
	</div>
  </body>
</html>
