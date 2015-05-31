<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Accorder une carte</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Accorder une carte prépayée</h1>
		</div>
		<form method="POST" action="verif-carte.php">
			<div class="form-group">
				<label for="dateExpi">Date d'expiration</label>
				<input type="date" name="dateExpi" class="form-control" id="dateExpi" placeholder="Entrez la date d'expiration">
			</div>
			<div>
				<label for="montant">Montant</label>
				<input type="text" name="montant" class="form-control" id="montant" placeholder="Entrez le montant de la carte">
			</div>
			<div class="form-group">
				<label for="client">Client</label>
				<select type="text" name="client" class="form-control" id="client" placeholder="Entrez le bénéficiaire de la carte">
				<?php
					include('connect.php');
					$db=fConnect();
					$sql="Select nom from utilisateur";
					$req=pg_query($db, $sql);
					while($res=pg_fetch_array($req, null, PGSQL_ASSOC))
					{
						echo('<option>'.$res['nom'].'</option>');
					}
				?>
				</select>
			</div>
			<br>
			<button type="submit" class="btn btn-default">Accorder la carte</button>
		</form>
		<br/>
		<a href="menu_admin.php">Retour</a>
	</div>
  </body>
</html>