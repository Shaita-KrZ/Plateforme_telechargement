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
    <title>Historique</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Historique des achats et des installations</h1>
		</div>
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th>Ressource achetée</th>
					<th>Application achetée</th>
					<th>Installé sur le terminal</th>
					<th>Numero de série du Terminal</th>
				</tr>
				<?php
				include('connect.php');
				$db = fConnect();
				
				
				$sql = "SELECT res, app, designation, T.numero_serie
						FROM Utilisateur U, ProduitAchete PA, Installe_sur INS, Terminal T, Modele M
						WHERE U.idClient =".$_SESSION['id']." 
						AND T.numero_serie =INS.terminal
						AND PA.id = INS.produit
						AND T.modele = M.id
						AND PA.proprietaire = U.idClient";
				$req = pg_query($db, $sql);

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					echo('<tr>');
					echo('<td>' . $res['res'] . '</td>');
					echo('<td>' . $res['app'] . '</td>');
					echo('<td>' . $res['designation'] . '</td>');
					echo('<td>' . $res['numero_serie'] . '</td>');
					echo('</tr>');
				}

				?>
			</table>
		</div>
		<a href="menu_user.php">Retour</a>
	</div>
  </body>
</html>
