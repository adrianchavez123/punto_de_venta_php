<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	
	require_once("php/Producto.php");
	$con = new Conexion();
	$session = new SessionAdmin();
	$alert = new Alert();
	$session->verificar();
	$producto = new Producto();
	
	if($con->conectar())
	{
		
		
	}
	else
	{
		$alert->imprimir("No se pudo conectar a la base de datos",1);
	}
?>
<html>
<head>
	<title>Administrador</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link href="zebra_pagination.css" rel="stylesheet">
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
				
					<li><a href="">Movimientos</a>
						<ul>
							<li><a href="AltaProducto.php" target="marco">Agregar un producto</a></li>
							<li><a href="bajaproductos.php" target="marco">Eliminar un producto</a></li>
							<li><a href="Modificar_precio.php" target="marco">modificar un producto</a></li>
							<li><a href="buscarproducto.php" target="marco">buscar un producto</a></li>
						</ul>
					</li>
					<li><a href="">Reportes</a>
						<ul>
							<li><a href="reportes.php">Generar Reporte</a></li>
							
						</ul>
					</li>
					<li><a href="php/cerrarAdmin.php">Cerrar sesión</a></li>
				</ul>
					
			</nav>
			<br>
			<br>
			<br>
			
			
		</header>
		
		<section>
			<iframe  id="marco" name="marco" src="prods.php">
						</iframe>
		</section>
		
		<footer>
			<h3 id="foot" align="center">Mi direccion &nbsp || &nbsp Mi telefóno &nbsp || &nbsp mi email</h3>
		</footer>
	</section>
</body>
</html>