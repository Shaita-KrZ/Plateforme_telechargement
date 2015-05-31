<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Ajout Ressource</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Ajouter une ressource</h1>
		</div>
		<form method="POST" action="verification-ressource.php">
			<div class="form-group">
				<label for="nom">Nom</label>
				<input type="text" name="nom" class="form-control" id="nom" placeholder="Entrez le nom de l'application">
			</div>
			<div class="form-group">
				<label for="editeur">Editeur</label>
				<select name="editeur" class="form-control" id="editeur" placeholder="Entrez l'editeur">
				<?php
					include('connect.php');
					$db=fConnect();
					$sql="Select nom from editeur";
					$req=pg_query($db, $sql);
					while($res=pg_fetch_array($req, null, PGSQL_ASSOC))
					{
						echo('<option>'.$res['nom'].'</option>');
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="app">Application</label>
				<select name="app" class="form-control" id="app" placeholder="Entrez l'application">
				<?php
					$sql2="Select nom from application";
					$req2=pg_query($db, $sql2);
					while($res2=pg_fetch_array($req2, null, PGSQL_ASSOC))
					{
						echo('<option>'.$res2['nom'].'</option>');
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<input type="textarea" name="description" class="form-control" id="description" placeholder="Entrez la description">
			</div>
			<div>
				<label for="prix">Prix</label>
				<input type="number" value="0" name="prix" class="form-control" id="prix" placeholder="Entrez le prix">
			</div>
			<div class="form-group">
				<label for="OS">Disponible pour</label>
				<select name="OS" class="form-control" id="OS" placeholder="Ressource disponible pour l'OS">
					<?php
					$sql3="Select version from OS";
					$req3=pg_query($db, $sql3);
					while($res3=pg_fetch_array($req3, null, PGSQL_ASSOC))
					{
						echo('<option>'.$res3['version'].'</option>');
					}
				?>
				</select>
			</div>
			
			<br>
			<button type="submit" class="btn btn-default">Ajouter la ressource</button>
		</form>
		<br/>
		<a href="menu_admin.php">Retour</a>
	</div>
  </body>
</html>