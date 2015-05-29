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
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<td>Nom de l'éditeur</td>
					<td>CA vente d'application</td>
					<td>CA vente de ressource</td>
					<td>CA vente d'abonnement</td>
					<td>CA global</td>
				</tr>
				<?php
				include('connect.php');
				$db = fConnect();
				
				$sql = "SELECT E.nom AS Editeur, CA_2.CA_app AS Apps, CA_1.CA_res AS Res, CA_3.CA_Ab AS Abonnement, SUM(CA_2.CA_app + CA_1.CA_res + coalesce(CA_3.CA_Ab,0)) AS CA
				FROM Editeur E
				LEFT OUTER JOIN
				(
					SELECT sum(R.prix) as CA_res, E.nom as Nom
					FROM Editeur E, Transaction T, Ressource R, Achat_simple_ressource ASR
					WHERE R.editeur = E.id
					AND ASR.ressource = R.nom
					AND ASR.achat = T.id
					GROUP BY E.nom
					ORDER BY CA_res DESC
				) AS CA_1
				ON E.nom = CA_1.Nom
				LEFT OUTER JOIN 
				(
					SELECT sum(A.prix) as CA_app, E.nom as Nom
					FROM Editeur E, Application A, Achat_simple_app ASA, Transaction T 
					WHERE A.editeur = E.id
					AND ASA.achat = T.id
					AND ASA.app = A.nom
					GROUP BY E.nom
					ORDER BY CA_app DESC
				) AS CA_2
				ON E.nom = CA_2.Nom
				LEFT OUTER JOIN
				(
					SELECT SUM(Ab.prixabonnement*Ab.nbmois) AS CA_Ab, E.nom as Nom
					FROM Abonnement Ab, application A, Editeur E, Transaction T
					WHERE Ab.app = A.Nom
					AND T.id = Ab.achat
					AND A.editeur = E.id
					GROUP BY E.nom
					ORDER BY CA_Ab DESC
				) AS CA_3
				ON E.nom = CA_3.nom
				GROUP BY E.nom, CA_2.CA_app, CA_1.CA_res, CA_3.CA_Ab
				ORDER BY CA DESC";
				
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo("<tr>");
					echo('<td>' . $res['editeur'] . '</td>');
					echo('<td>' . round($res['apps'],2) . '€</td>');
					echo('<td>' . round($res['res'],2) . '€</td>');
					echo('<td>' . round($res['abonnement'],2) .'€</td>');
					echo('<td>' . round($res['ca'],2) . '€</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>

		<h1>Liste des éditeurs avec le plus de ventes</h1>
		<div class="panel-default panel">
			<table class="table">
				<tr>
					<td>Nom de l'éditeur</td>
					<td>Nombre de ventes de ressource</td>
					<td>Nombre de ventes d'application</td>
					<td>Nombre de ventes d'abonnement</td>
					<td>Nombre de ventes total</td>
				</tr>
				<?php
		
				$sql = "SELECT E.nom AS Editeur, COALESCE(NB_1.nb_res,0) as res, COALESCE(NB_2.nb_app,0) as app, 					COALESCE(NB_3.nb_ab,0) as abonnement, SUM(NB_2.nb_app + NB_1.nb_res + COALESCE(NB_3.nb_ab,0)) as total
				FROM Editeur E
				LEFT OUTER JOIN
				(
					SELECT COUNT(*) as nb_res, E.nom as Nom
					FROM Editeur E, Transaction T, Ressource R, Achat_simple_ressource ASR
					WHERE R.editeur = E.id
					AND ASR.ressource = R.nom
					AND ASR.achat = T.id
					GROUP BY E.nom
					ORDER BY nb_res DESC
				) AS NB_1
				ON E.nom = NB_1.Nom
				LEFT OUTER JOIN 
				(
					SELECT COUNT(*) as nb_app, E.nom as Nom
					FROM Editeur E, Application A, Achat_simple_app ASA, Transaction T 
					WHERE A.editeur = E.id
					AND ASA.achat = T.id
					AND ASA.app = A.nom
					GROUP BY E.nom
					ORDER BY nb_app DESC
				) AS NB_2
				ON E.nom = NB_2.Nom
				LEFT OUTER JOIN
				(
					SELECT COUNT(*) AS nb_ab, E.nom as Nom
					FROM Abonnement Ab, application A, Editeur E, Transaction T
					WHERE Ab.app = A.Nom
					AND T.id = Ab.achat
					AND A.editeur = E.id
					GROUP BY E.nom
					ORDER BY nb_ab DESC
				) AS NB_3
				ON E.nom = NB_3.nom
				GROUP BY E.nom, NB_1.nb_res, NB_2.nb_app, NB_3.nb_ab
				ORDER BY total DESC";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					echo('<td>' . $res['editeur'] . '</td>');
					echo('<td>' . $res['res'] . '</td>');
					echo('<td>' . $res['app'] . '</td>');
					echo('<td>' . $res['abonnement'] . '</td>');
					echo('<td>' . $res['total'] . '</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>
		<a href="menu_analyst.php">Retour</a>
	</div>
  </body>
</html>
