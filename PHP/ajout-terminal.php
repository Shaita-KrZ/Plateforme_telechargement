<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Ajouter un terminal</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Ajouter un terminal</h1>
		</div>
		<form method="POST" action="verification-terminal.php">
			<div class="form-group">
				<label for="numSerie">Numero de serie du terminal</label>
				<input type="text" name="numSerie" class="form-control" id="numSerie" placeholder="Entrez le numero de serie de votre terminal">
			</div>
			<div>
				<label for="modele">Modèle du terminal</label>
				<select name="modele" class="form-control" id="modele" placeholder="Choisissez le modele du terminal">
				<?php
					include('connect.php');
					$db=fConnect();
					
					$sql="select designation from modele";
					
					$req = pg_query($db, $sql);
					
					while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
					{
						echo('<option>'.$res['designation'].'</option>');
					}
				?>
				</select>
			</div>
			<br>
			<button type="submit" class="btn btn-default">Ajouter</button>
		</form>
	</div>
  </body>
</html>