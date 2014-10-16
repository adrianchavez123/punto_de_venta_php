<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	require_once("php/Producto.php");
	
	$con = new Conexion();
	$session = new SessionAdmin();
	$sentencia;
	
	$session->verificar();
	$alert = new Alert();
	
	$producto = new Producto();
	$agregar = true;
	if($con->conectar())
	{
		//echo "ya puedo comenzar";
		
		if(isset($_POST['cat']) && isset($_POST['nombre']) && !empty($_POST['nombre']))
		{
			//$sentencia = "insert into categorias (nombre)values('".$_POST['nombre']."')";
			
			$producto->setCategoria($_POST['nombre']);
			if($producto->createCategoria())
			{
				$alert->imprimir("Los datos fueron ingresados correctamente.",3);
			}
			else
			{
				$alert->imprimir("Los datos no fuero ingresados.",1);
			}
		}
		if(isset($_POST['prod']) && $agregar = true)
		{
			$producto->setNombre($_POST['nombreprod']);
			$producto->setIdCategoria($_POST['categoria']);
			$producto->setCantidad($_POST['cantidad']);
			$producto->setPrecio($_POST['precio']);
			//$producto->setImagen($_FILE['imagen']);
			
			if($producto->createProducto())
			{
				$alert->imprimir("Los datos fueron ingresados correctamente.",3);
			}
			else
			{
				$alert->imprimir("Los datos no fueron ingresados.",1);
			}
		}
	}
	else
	{
		$alert->imprimir("Ocurrio un error al cargar la pagina.",1);
	}
	
?>
<html>
<head>
	<title>Alta Producto</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

	<section id="contenedor">
		
		<h1>Agregar un nuevo producto</h1>
		<section>
			<form action="" method="post" name="prod" enctype="multipart/form-data">
				<table>
					
				
					<tr>
						<td>
							Nombre
						</td>
						<td>
						<input id="campo" type=text name="nombreprod" id="nombreprod">
						</td>
						<td>
						<?php
			
							if(isset($_POST['nombreprod']) && empty($_POST['nombreprod']))
							{
								echo "<p class='error'>El nombre es necesario</p>";
								$agregar = false;
							}
							
						?>
						</td>
					</tr>
					
					<tr>
					
						<td>
						 <label>Categoria</label>
            
						</td>
						<td>
							<select class="form-control" name="categoria" id="campo">
				
								<?php
					
									$categorias = $con->getCategorias();
									$i = 1;
									foreach($categorias as $cat)
									{
										echo"<option value='".$i."'>".$cat."</option>";
										$i++;
									}
								?>
								
							</select>
						</td>
						<td>
							<?php
			
								if(isset($_POST['categoria']) && empty($_POST['categoria']))
								{
									echo "<p class='error'>La categoria es necesario</p>";
									$agregar = false;
								}
							
							?>
						</td>
					</tr>
					
					<tr>
						<td>
							Cantidad
						</td>
						<td>
						<input id="campo" type=number name="cantidad" id="cantidad">
						</td>
						<td>
						<?php
			
							if(isset($_POST['cantidad']) && empty($_POST['cantidad']))
							{
								echo "<p class='error'>El numero de productos en existencia es necesario</p>";
								$agregar = false;
							}
							
						?>
						</td>
					</tr>
					
					<tr>
						<td>
							Precio
						</td>
						<td>
							<input id="campo" type=text name="precio" id="precio"></br>						
						</td>
						<td>
							<?php
			
								if(isset($_POST['precio']) && empty($_POST['precio']))
								{
									echo "<p class='error'>El precio es necesario</p>";
									$agregar = false;
								}
								
							?>
						</td>
					</tr>
				
					<tr>
						<td>
							Imagen
						</td>
						<td>
							<input id="campo" type="file" name="imagen" id="imagen"></br>						
						</td>
					</tr>
					<tr> 
						
						<td colspan="2">
							 <input type="submit" value="Agregar" class="btn btn-success" name="prod">
						</td>
					</tr>
				
				
				</table>
			</form>
		</section>
		
		<article>
			<form action="" method="post">
				<table>
					
					<tr>
						<td><legend>Agregar una nueva categoria</legend>
						</td>
					</tr>
				
					<tr>
						<td>
							Nombre
						</td>
						<td>
						<input id="campo" type=text name="nombre" id="nombre">
						</td>
						
					</tr>
					
					<tr>
						<td>
						<input type="submit" value="Agregar" class="btn btn-success" name="cat">
						</td>
					</tr>
				</table>
			</form>
					
		</article>
		
		
	</section>
</body>
</html>