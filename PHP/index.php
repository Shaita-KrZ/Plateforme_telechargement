<?php
	session_start();
	
	if(isset($_SESSION['typeUser']))
	{
	
		if($_SESSION['typeUser']==='analyst')
			header('Location: menu_analyst.php');
		else if ($_SESSION['typeUser']=='admin')
			header('Location: menu_admin.php');
		else if ($_SESSION['typeUser']=='user')
			header('Location: menu_user.php');
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Accueil du NIMPSTORE</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Accueil - Connexion</h1>
		</div>
		<form method="POST" action="verification-login.php">
			<div class="form-group">
				<label for="nom">Login</label>
				<input type="text" name="login" class="form-control" id="login" placeholder="Entrez votre login">
			</div>
			<button type="submit" class="btn btn-default">Se connecter</button>
			<p>Pas encore de compte utilisateur ? <a href="inscription.php">Inscrivez-vous !</a></p>
		</form>	</div>
  </body>
</html>