<html>
<head>
	<title>Punto de venta</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
	
	<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	$con = new Conexion();
	$session = new Session();
	$alert = new Alert();
	$sentencia;
	if($con->conectar())
	{
		if(isset($_POST['username']) && !empty($_POST["username"])
		 && isset($_POST['password']) && !empty($_POST["password"]))
		{
			$sentencia = "select idUsuario from usuarios where username='".$_POST['username']."' and password='".md5($_POST['password'])."'";
			$id = $con->selectUser($sentencia);
			if($id)
			{
				$session->start($id);
			}
			else
			{
				$alert->imprimir("Datos invalidos",1);
			}
		}
?>

	<section id="contenedor">
		<header>
		
			<table class="head">
				<tr>
					<td>
						<img id="logo" />				
					</td>
					<td>
						<h1 class="empresa">Mi nombre de empresa</h1>
						<h3 class="slogan">Texto aquí</h3>
					</td>
				</tr>
			</table>
			
			<br>
			<br>
			<nav class="menu">
			
				<ul class="mi-menu">
				
					<li><a href="productos.php">Ingresar</a></li>
					<li><a href="registroAdmin.php">Administrador</a></li>
				</ul>
					
			</nav>
			<br>
			<br>
			<br>
			
			
		</header>
		
		<section class="contenido">
		
			<table colspan="4" class="noticias">
				<tr>
					<td>
						<article>
							<img  class="imagen1"/>
							<h4>Tips de construcciób</h4>
							<p>texto aquí texto aquí texto aquí texto aquí texto aquítexto <br>aquí texto aquí texto aquí texto aquí texto aquí texto aquí texto<br> aquí
							texto aquí texto aquí texto aquí texto aquí texto aquí<br> texto aquí texto aquí texto aquí
							</p>
						</article>
					</td>
					<td>
						<article>
				
							<img  class="imagen2"/>
							<h4>Comparativa cementos</h4>
							<p>texto aquí texto aquí texto aquí texto aquí texto aquítexto <br>aquí texto aquí texto aquí texto aquí texto aquí texto aquí texto<br> aquí
							texto aquí texto aquí texto aquí texto aquí texto aquí<br> texto aquí texto aquí texto aquí
							</p>
						</article>
					</td>
					<td>
						<article>
							<img class="imagen3"/>
							<h4>Materiales más usados</h4>
							<p>texto aquí texto aquí texto aquí texto aquí texto aquítexto <br>aquí texto aquí texto aquí texto aquí texto aquí texto aquí texto<br> aquí
							texto aquí texto aquí texto aquí texto aquí texto aquí<br> texto aquí texto aquí texto aquí
							</p>
						</article>
					<td>
					<td class="login">
					
						<nav class="nav_login">
							<form action="" method="post" name="frm">
								Username:<br>
								<input type="text" name="username"/><br>
								Password:<br>
								<input type="password" name="password"/><br>
								<input type="image" src="images/images.jpeg"/><br>
								
							</form>
							 <label></label><a href="altaCliente.php" >Registrarme</a><br>  
							  <label></label><a href="RecordarUsuario.php">Olvide mi cuenta</a> <br> 
							  <label></label><a href="RecordarPassword.php">Olvide mi contraseña</a>  
						</nav>
					</td>
				</tr>

				<tr>
					<td>
						<article>
							<img class="imagen4"/>
							<h4>Ofertas</h4>
							<p>texto aquí texto aquí texto aquí texto aquí texto aquítexto <br>aquí texto aquí texto aquí texto aquí texto aquí texto aquí texto<br> aquí
							texto aquí texto aquí texto aquí texto aquí texto aquí<br> texto aquí texto aquí texto aquí
							</p>
						</article>
					</td>
					<td>
						<article>
				
							<img class="imagen5"/>
							<h4>Nueva medida</h4>
							<p>texto aquí texto aquí texto aquí texto aquí texto aquítexto <br>aquí texto aquí texto aquí texto aquí texto aquí texto aquí texto<br> aquí
							texto aquí texto aquí texto aquí texto aquí texto aquí<br> texto aquí texto aquí texto aquí
							</p>
						<article>
					</td>
					<td>
						<article>
							<img class="imagen6"/>
							<h4>Revolvedoras</h4>
							<p>texto aquí texto aquí texto aquí texto aquí texto aquítexto <br>aquí texto aquí texto aquí texto aquí texto aquí texto aquí texto<br> aquí
							texto aquí texto aquí texto aquí texto aquí texto aquí<br> texto aquí texto aquí texto aquí
							</p>
						</article>
					<td>
				</tr>
			</table>
		
		</section>
		
		<?php
			
		}
		else
		{
			$alert->imprimir("No se pudo conectar al servidor de Bases de Datos",1);
		}
		?>
		<footer>
			<h3 id="foot">Mi direccion &nbsp || &nbsp Mi telefóno &nbsp || &nbsp mi email</h3>
		</footer>
	
	</section>
	

</body>
</html>
