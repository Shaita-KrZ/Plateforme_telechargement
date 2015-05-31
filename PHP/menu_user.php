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
    <title>Menu Utilisateur</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<?php
				echo('<h1>Bonjour '.$_SESSION['nom'].' '.$_SESSION['prenom'].'.</h1>');
			?>
			<h2>Menu Utilisateur</h2>
		</div>
		<div>
			<ul>
				<li><a href="apps.php">Les applications compatibles avec mes terminaux</a></li>
				<li><a href="historique.php">Historique d'achat et d'installation d'applications</a></li>
				<li><a href="terminaux.php">Gérer mes terminaux</a></li>
				<br/>
				<li><a href="deconnexion.php">Deconnexion</a></li>
			</ul>
		</div>
	</div>
  </body>
</html>
