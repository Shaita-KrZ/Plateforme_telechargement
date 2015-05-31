<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Ajout Editeur</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Ajouter un Editeur</h1>
		</div>
		<form method="POST" action="verification-editeur.php">
			<div class="form-group">
				<label for="nom">Nom</label>
				<input type="text" name="nom" class="form-control" id="nom" placeholder="Entrez le nom de l'editeur">
			</div>
			<div class="form-group">
				<label for="contact">Contact</label>
				<input type="text" name="contact" class="form-control" id="contact" placeholder="Entrez le contact">
			</div>
			<div>
				<label for="url">URL</label>
				<input type="text" name="url" class="form-control" id="url" placeholder="Entrez l'url de l'editeur">
			</div>
			<br>
			<button type="submit" class="btn btn-default">Ajouter l'editeur</button>
		</form>
		<br/>
		<a href="menu_admin.php">Retour</a>
	</div>
  </body>
</html>