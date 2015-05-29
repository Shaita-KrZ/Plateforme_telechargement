<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Applications les plus rentables</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Liste des applications les plus rentables</h1>
		</div>
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<td>Nom de l'application</td>
					<td>Prix</td>
					<td>CA des ventes</td>
					<td>CA des abonnements</td>
					<td>CA global</td>
				</tr>
				<?php
				include('connect.php');
				$db = fConnect();
				
				$sql = "SELECT A.nom AS nom, A.prix AS prix, COALESCE(CA_1.CA_Ventes,0) AS Ventes , COALESCE	(CA_2.CA_Ab,0) AS Abonnement, SUM(COALESCE(CA_1.CA_Ventes,0)+COALESCE(CA_2.CA_Ab,0)) AS total
					FROM application A 
					LEFT OUTER JOIN 
					(
						SELECT Achat.app AS Nom, COALESCE(SUM(A.prix)) AS CA_Ventes
						FROM achat_simple_app Achat, application A
						WHERE Achat.app = A.Nom
						GROUP BY Achat.app
						ORDER BY CA_Ventes DESC
					) AS CA_1
					ON A.nom = CA_1.Nom
					LEFT OUTER JOIN 
					(
						SELECT Ab.app AS Nom, SUM(Ab.prixabonnement*Ab.nbmois) AS CA_Ab
						FROM abonnement Ab, application A
						WHERE Ab.app = A.Nom
						GROUP BY Ab.app
						ORDER BY CA_Ab DESC
					) AS CA_2
					ON A.nom = CA_2.Nom
					GROUP BY A.nom, A.prix, CA_1.CA_Ventes, CA_2.CA_Ab 
					ORDER BY total DESC";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					echo('<td>' . $res['nom'] . '</td>');
					echo('<td>' . round($res['prix'],2) . '€</td>');
					echo('<td>' . round($res['ventes'],2) . '€</td>');
					echo('<td>' . round($res['abonnement'],2) . '€</td>');
					echo('<td>' . round($res['total'],2) . '€</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>
		<a href="menu_analyst.php">Retour</a>
	</div>
  </body>
</html>
