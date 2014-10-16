<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	
	$con = new Conexion();
	$session = new SessionAdmin();
	$alert = new Alert();
	$session->verificar();
	
	if($con->conectar())
	{
		//echo "ya puedo comenzar";
		
		
	}
	else
	{
		$alert->imprimir("No se pudo conectar a la base de datos",1);
	}
?>
<html>
<head>
	<title>Reportes</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

	<section id="contenedor">
		<header>
		
			<table class="head">
				<tr>
					<td>
						<img id="logo" />					
					</td>
					<td>
						<h1 class="empresa"align="right">Mi nombre de empresa</h1>
						<h3 class="slogan" align="right">Texto aquí</h3>
					</td>
				</tr>
			</table>
			
			<br>
			<br>
			<nav class="menu">
			
				<ul class="mi-menu">
				
					<li><a href="buscar_factura.php" target="marco">Nota/factura</a>
						
					</li>
					<li><a href="buscar_articulo.php" target="marco">Articulos</a>
						
					</li>
					<li><a href="buscar_cliente.php" target="marco">clientes</a></li>
					
					</li>
					<li><a href="php/cerrarAdmin.php">cerrar sesión</a></li>
				</ul>
					
			</nav>
			<br>
			<br>
			<br>
			
			
		</header>
	
		<br>
		<br>
			<h1 id="tit">Reportes</h1>
		
		<section>
			<table  colspan="2">
				
				<tr>
					<td>
						<h2>Generar reportes</h2><br>
						<nav>
							<ul class="lista">					
								<li><a href="buscar_factura.php" target="marco">Nota/factura</a></li>
								<li><a href="buscar_articulo.php" target="marco">articulos</a></li>
								<li><a href="buscar_cliente.php" target="marco">clientes</a></li>
							</ul>
						</nav>
					</td>
					<td>	<!-- contenedor hace un nuevo marco -->
						<iframe  id="marco" name="marco">
						</iframe>
					</td>
				</tr>
				
			</table>
		</section>
		<footer>
			<h3 id="foot">Mi direccion &nbsp || &nbsp Mi telefóno &nbsp || &nbsp mi email</h3>
		</footer>
	
	</section>

</body>
</html>