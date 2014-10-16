<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Productos</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	
</head>
<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	
	$con = new Conexion();
	$session = new Session();
	$alert = new Alert();
	$session->verificar();
	
	//echo "<h1>id ".$_SESSION['id']."</h1>";
?>




<body>

	<header>
	
		<table class="head">
			<tr>
				<td>
					<img id="logo" />				
				</td>
				<td>
					<h1 class="empresa">Mi nombre de empresa</h1>
					<h3 class="slogan" >Texto aquí</h3>
				</td>
			</tr>
		</table>
	</header>
	<br>
	<br>
	<nav class="menu">
		<ul class="mi-menu">
			<li><a href="miCuenta.php">Mi Cuenta</a></li>
			<li><a href="php/cerrarSession.php">Cerrar sesion</a></li>
		</ul>
					
	</nav>
	<br>
	<br>
	<br>

	<section>
	<?php
	
		if($con->conectar())
	{
		
	
	?>
		<form action="detalleCompra.php" method="post">
		
			<table id="tabla_productos">
			
				<tr>
				<th>Imagen</th>
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Existencia</th>
				<th>Comprar</th>
			</tr>
			
			<?php
			
				$sentencia = '
					SELECT
					IdProducto,nombre,rutaImagen,precio,cantidad
					FROM
					productos where estado = 1';
				
				$result = mysql_query($sentencia,$con->con);
				$i = 0;
				while($x = mysql_fetch_array($result))
				{
					
					?>		
					<tr>
						<td>
						<img src="<?php echo $x["rutaImagen"]; ?>" class="imagenes">
						</td>
						<td><h4><?php echo $x["nombre"]; ?></h4></td>
						<td><p>Precio: <?php echo $x["precio"]; ?></p></td>
						<td><p>Existencia:<?php echo $x["cantidad"]; ?></p></td>
						<td><label>Cantidad:<input type="number" name="cantidad[<?php echo $x["IdProducto"]; ?>]" value="1"></label></td>
						<td><label>Comprar:<input type="checkbox" name="comprar[<?php echo $x["IdProducto"]; ?>]"></label></td>
							
						</td>
					
					</tr>	
					<?php
					
				}
			?>
			
				<tr>
					<td colspan="6">
						 <hr>
		
						<input type="submit" value="Colocar Pedido" class="btn btn-success btn-large" name="pedido">
					</td>
				</tr>
			</table>
			<h4>EL precio actual no contiene el iva incluido</h4>
       
			
			
		<form>
	<?php
	
	}
	else
	{
		$alert->imprimir("No se pudo conectar a la base de datos",1);
	}
	?>
	</section>

	<footer>
		<h3 id="foot">Mi direccion &nbsp || &nbsp Mi telefóno &nbsp || &nbsp mi email</h3>
	</footer>
</body>
</html>
