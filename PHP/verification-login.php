<?php 
	session_start();

if(isset($_POST['login']))
{
	if($_POST['login'] == 'analyst')
	{
		$_SESSION['typeUser']='analyst';
		header('Location: menu_analyst.php');
	}
	elseif($_POST['login'] == 'admin')
	{
		$_SESSION['typeUser']='admin';
		header('Location: menu_admin.php');
	}
	else
	{
		include('connect.php');
		$login=$_POST['login'];
		$db=fConnect();
		$sql="Select idClient as id, nom, prenom from utilisateur where nom='$login'";
		$req=pg_query($db, $sql);
		if($res=pg_fetch_array($req, null, PGSQL_ASSOC))
			{
				$_SESSION['typeUser']='user';
				$_SESSION['nom']=$res['nom'];
				$_SESSION['prenom']=$res['prenom'];
				$_SESSION['id']=$res['id'];
				header('Location: menu_user.php');
			}
		else{
			header('Location: login-erreur.php');
		}
	}
}

 ?>