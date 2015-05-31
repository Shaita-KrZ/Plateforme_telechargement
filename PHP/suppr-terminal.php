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
    <title>Supprimer un terminal</title>
  </head>	
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Supprimer un terminal</h1>
		</div>
		<form method="POST" action="verif-suppr-terminal.php">
			<div>
				<label for="numSerie">Numéro de série du terminal</label>
				<select name="numSerie" class="form-control" id="numSerie" placeholder="Choisissez le numero de série du terminal">
				<?php
					include('connect.php');
					$db=fConnect();
					
					$sql="select numero_serie from Terminal where proprietaire=".$_SESSION['id'];
					
					$req = pg_query($db, $sql);
					
					while($res = pg_fetch_array($req, null, PGSQL_ASSOC))
					{
						echo('<option>'.$res['numero_serie'].'</option>');
					}
				?>
				</select>
			</div>
			<br>
			<button type="submit" class="btn btn-default">Supprimer</button>
		</form>
	</div>
  </body>
</html>