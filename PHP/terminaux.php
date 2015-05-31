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
    <title>Mes terminaux</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Mes Terminaux</h1>
		</div>
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th>Numéro de série</th>
					<th>Modèle</th>
					<th>OS</th>
				</tr>
				<?php
				include('connect.php');
				$db = fConnect();
				
				
				$sql = "SELECT T.numero_serie as numero_serie, M.designation as designation, OS.version as version
						FROM terminal T, modele M, OS
						where 
						OS.id=M.id
						AND T.modele = M.id
						AND T.proprietaire=".$_SESSION['id'];
				$req = pg_query($db, $sql);
				
				$nbTerminaux=0;

				while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
				{
					$nbTerminaux++;
					echo('<tr>');
					echo('<td>' . $res['numero_serie'] . '</td>');
					echo('<td>' . $res['designation'] . '</td>');
					echo('<td>' . $res['version'] . '</td>');
					echo('</tr>');
				}
				?>
			</table>
		</div>
		<?php
			if($nbTerminaux<5)
				echo('<a href="ajout-terminal.php">Ajouter un terminal</a><br/>');
			if($nbTerminaux>1)
				echo('<a href="suppr-terminal.php">Supprimer un terminal</a><br/>');
		?>
		<br/>
		<a href="menu_user.php">Retour</a>
	</div>
  </body>
</html>
