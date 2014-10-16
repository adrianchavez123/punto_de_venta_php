<?php
	
	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	
	$con = new Conexion();
	$session = new SessionAdmin();
	$sentencia;
	$alert = new Alert();
	if($con->conectar())
	{
		//echo "ya puedo comenzar";
		
		if(isset($_POST["user"]) && !empty($_POST['user'])
	   && isset($_POST["password"]) && !empty($_POST['password']))
		{
			$sentencia = "Select * from administradores where username='"
			.$_POST['user']."' and password='".md5($_POST['password'])."'";
			
			if($con->selectAdmin($sentencia))
			{
				
				$session->start();
			}
			else
			{
				header("location:index.php");
				exit;
			}
		}
		else
		{
	
	
	
		
	
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style_reg.css"/>
</head>
<body>

	<section class="reg">
	<form action = "" method="post">
		<table>
			<tr>

				<td><label>Usuario</label></td>
				<td><input type="text" name="user"></td>
			</tr>
				<td>Contraseña</td>
				<td><input type="password" name="password"></td>
				
			</tr>
			<tr>
				<td colspan="2"><input type="image" src="images/images.jpeg"name="log"></td>
			</tr>
		</table>
	</form>
	</section>
	
	<?php
	
		}
		
	}
	else
	{
		$alert->imprimir("No se pudo conectar a la base de datos",1);
	}
	?>
</body>
</html>
