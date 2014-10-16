<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	require_once("php/Producto.php");
	$con = new Conexion();
	$session = new SessionAdmin();
	$nombreProducto;
	$session->verificar();
	$alert = new Alert();
	
	$producto = new Producto();
	
	if($con->conectar())
	{
		//echo "ya puedo comenzar";
		
		if(isset($_POST['eliminar'])
		  
		  )
		{
			
			if($producto->getIdByNombre($_POST['nombre']))
			{
				if($producto->updateEstado(0))
				{
					$alert->imprimir("El producto fue eliminado satisfactoriamente.",2);
				}
				else
				{
					$alert->imprimir("El producto no pudo ser eliminado.",1);
				}
			}
			else
			{
				$alert->imprimir("El producto no pudo ser eliminado.",1);
				
			}
			
		}
		
	}
	else
	{
		$alert->imprimir("No se pudo conectar al servidor",1);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Baja Producto</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

	<section id="contenedor">
		
		<h1>Eliminar un producto</h1>
		<section>
		<?php
		if(isset($_POST['buscar']) && isset($_POST['nombre']) && !empty($_POST['nombre']))
		{
					
			if($producto->getIdByNombre($_POST['nombre']))
			{

	  ?>
			<form action="" method="post">
				<table>
					
				
					<tr>
						<td>
							Nombre
						</td>
						<td>
						<input id="campo" type=text name="nombre" value="<?php  echo $producto->getNombre();?>" readonly>
						</td>
					</tr>
					
					<tr>
						<td>
						Categoria
						</td>
						<td>
							<select class="form-control" name="categoria" readonly id="campo">
								<?php
					
									if($producto->setCategoriaById($producto->getIdCategoria()))
									{
									
										echo "<option>".$producto->getCategoria()."</option>";
									}
									else
									{
										echo "<option>"."error"."</option>";
									}
								?>
								
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Cantidad
						</td>
						<td>
						<input id="campo" type=number name="cantidad" value="<?php  echo $producto->getCantidad();?>" readonly>
						</td>
					</tr>
					
					<tr>
						<td>
							Precio
						</td>
						<td>
							<input id="campo" type=text name="precio"  value="<?php  echo $producto->getPrecio();?>" readonly>					
						</td>
					</tr>
				
					<tr>
						<td>
							Imagen
						</td>
						<td>
							<?php  echo $producto->getRutaImagen();?>						
						</td>
					</tr>
					<tr> 
						
						<td colspan="2">
							 <input type="submit" value="Eliminar" class="btn btn-warning" name="eliminar">
						</td>
					</tr>
				
				
				</table>
			</form>
		<?php
			}
			else
			{
				$alert->imprimir("El producto no encontrado.",1);
				
			}
		?>
		</section>
		 <?php
		}
		else
		{
		?>
		<article>
			
			<form action="" method="post" >
				<table>
					<tr>
					<td><legend>Nombre del Producto a Eliminar</legend></td>
					</tr>
					<tr>
						<td>
							<select class="form-control" name="nombre" id="campo">
							
								<?php
					
									$categorias = $producto->getProductos();
									$i = 1;
									foreach($categorias as $cat)
									{
										echo"<option value='".$cat."'>".$cat."</option>";
										$i++;
									}
								?>
								
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="Buscar" class="btn btn-success" name="buscar">
						</td>
					</tr>
				</table>
          </form>
		
		</article>
		<?php
		}
	  ?>
		
	
	</section>
	
	
</body>
</html>