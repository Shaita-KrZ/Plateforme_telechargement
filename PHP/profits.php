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
			<h1>Liste des profits</h1>
		</div>
		<h1>Profit du NIMPStore</h1>

		<?php
		include('connect.php');
		$db = fConnect();
		
		$sql = "SELECT SUM(CA_2.CA_app + CA_1.CA_res + coalesce(CA_3.CA_Ab,0))*0.3 AS CA
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
		ON E.nom = CA_3.nom";
		$req = pg_query($db, $sql);

		$res = pg_fetch_array($req, null, PGSQL_ASSOC);
		echo('<p>Le NIMPStore a fait un profit de ' . round($res['ca'],2) . '€ depuis sa création (#business)</p>');
		?>


		<h1>Liste des profits des éditeurs</h1>
		<div class="panel-default panel">
			<table class="table">
				<tr>
					<td>Nom de l'éditeur</td>
					<td>Bénéfice (70% du CA réalisé)</td>
				</tr>
				<?php
				
				$sql = "SELECT E.nom AS Editeur, SUM(coalesce(CA_2.CA_app,0) + coalesce(CA_1.CA_res,0) + 					coalesce(CA_3.CA_Ab,0))*0.7 AS benef
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
					GROUP BY E.nom
					ORDER BY benef DESC";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					echo('<td>' . $res['editeur'] . '</td>');
					echo('<td>' . round($res['benef'],2) . '</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>
		<a href="menu_analyst.php">Retour</a>
	</div>
  </body>
</html>
