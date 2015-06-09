<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Inscription</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Inscription</h1>
		</div>
		<form method="POST" action="verification-inscription.php">
			<div class="form-group">
				<label for="login">Login</label>
				<input type="text" name="login" class="form-control" id="login" placeholder="Entrez un login (pour identification)">
			</div>
			<div class="form-group">
				<label for="nom">Nom</label>
				<input type="text" name="nom" class="form-control" id="nom" placeholder="Entrez votre nom">
			</div>
			<div class="form-group">
				<label for="prenom">Prénom</label>
				<input type="text" name="prenom" class="form-control" id="prenom" placeholder="Entrez votre prénom">
			</div>
			<div class="form-group">
				<label for="terminal">Numero de serie du terminal</label>
				<input type="text" name="terminal" class="form-control" id="terminal" placeholder="Entrez le numero de serie de votre terminal">
			</div>
			
			
			<div>
				<label for="modele">Modèle du terminal</label>
				<select name="modele" id="modele" class="form-control">
				<?php
						include("connect.php");
						$vConn=fConnect();
						$vSql="SELECT id FROM Modele";
						$vQuery=pg_query($vConn,$vSql);
						while($vResult=pg_fetch_array($vQuery)){
							echo "<option>";
							echo $vResult['id']; 
							echo "</option>";
						}
				?>
				</select>
			</div>
			
			<br>
			<button type="submit" class="btn btn-default">S'inscrire</button>-
		</form>
	</div>
  </body>
  
</html>