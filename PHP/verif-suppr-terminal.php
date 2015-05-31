<?php
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Verification Suppression terminal</title>
  </head>
  <body>
	<div class="container">
		<div id="header" class="jumbotron">
			<h1>Validation de la suppression</h1>
		</div>
	<?php
	$numSerie=$_POST['numSerie'];
	if(empty($numSerie)){
		header('Location: suppr-terminal.php');
		exit();
	}
	
	include("connect.php");
	$vConn=fConnect();
	
	$sql1="delete from Terminal where numero_serie='$numSerie'";
	$req=pg_query($vConn, $sql1);
	?>
	
	<h2> La suppression du terminal a été pris en compte</h2>
		<!-- insert une ligne horizontal --> <hr>
	<p><a href="terminaux.php"> Retour aux terminaux </a></p>
	</div>
  </body>
</html>