<?php 

if(isset($_POST['login']))
{
	if($_POST['login'] == 'analyst')
	{
		header('Location: menu_analyst.php');
	}
	elseif($_POST['login'] == 'admin')
	{

	}
	elseif($_POST['login'] == 'user')
	{

	}
	else
	{

	}
}
else
{
	
}

 ?>