<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Subir.php");
	require_once("php/Alert.php");
	require_once("php/Producto.php");
	
	$con = new Conexion();
	$session = new SessionAdmin();
	
	$session->verificar();
	$alert = new Alert();
	$subir = new Subir();
	$producto = new Producto();
	$agregar = true;
	if($con->conectar())
	{
		
		
		
	}
	else
	{
		$alert->imprimir("No se pudo conectar a la base de datos.",1);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar producto</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

	<section id="contenedor">
		
		<h1>Modificar Producto</h1>
		<br>
		<br>
		 <?php
		if(isset($_POST['modificar']) && $agregar = true)
		{
			
			if($producto->getIdByNombre($_POST['nombreHidden']))
			{
				
				if($producto->updateNombre($_POST['nombre']))
				{
					$alert->imprimir("El nombre fue actualizado.",3);
				}
				else
				{
					$alert->imprimir("No se pudo actualizar el nombre.",1);
				}
				
				if($producto->updateCantidad($_POST['cantidad']))
				{
					$alert->imprimir("La cantidad fue actualizado.",3);
				}
				else
				{
					$alert->imprimir("No se pudo actualizar la cantidad.",1);
				}
				
				if($producto->updatePrecio($_POST['precio']))
				{
					$alert->imprimir("El precio fue actualizado.",3);
				}
				else
				{
					$alert->imprimir("No se pudo actualizar el precio.",1);
				}
				if($producto->updateRutaImagen($_POST['nombre']))
				{
					$alert->imprimir("La imagen  fue actualizada.",3);
				}
				else
				{
					$alert->imprimir("No se pudo actualizar la imagen.",1);
				}
			}
			else
			{
				$alert->imprimir("No se pudo obtener los datos.",1);
			}
			
			
		}
		
		if(isset($_POST['buscar']) && isset($_POST['nombre']) && !empty($_POST['nombre']))
		{
			//echo "<h1>nombre : ".$_POST['nombre']."</h1>";
			if($producto->getIdByNombre($_POST['nombre']))
			{
			}
			else
			{
				$alert->imprimir("No se pudo obtener los datos.",1);
			}
		
	  ?>
		<article>
			<form action="" method="post" enctype="multipart/form-data">
            
				<table>
					<tr>
						<td><legend>Datos del Producto</legend>
						</td>
					</tr>
			
					<tr>
						<td><label>Nombre</label></td>
						<td><input type="text" name="nombre" value="<?php  echo $producto->getNombre(); ?>">
						<input type="hidden" name="nombreHidden" value="<?php  echo $producto->getNombre(); ?>">
						</td>
						<td>
							<?php
					
								if(isset($_POST['nombre']) && empty($_POST['nombre']))
								{
									echo "<p class='error'>El nombre es necesario</p>";
									$agregar = false;
								}
								
							?>
						</td>
					</tr>
					<tr>
					
						<td><label>Categoria</label></td>
						
						   <td><select class="form-control" readonly>
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
					
						<td><label>Cantidad</label></td>
						<td><input type="number" name="cantidad"  value="<?php  echo $producto->getCantidad();?>"></td>
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
					
						<td><label>Precio publico</label></td>
						<td><input type="text" name="precio"  value="<?php  echo $producto->getPrecio();?>"></td>
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
					
						<td><label>Imagen:<?php  echo $producto->getRutaImagen();?></label></td>
						<td><input type="file" name="imagen"></td>
					</tr>
					<tr>
						<td><input type="hidden" name="Idproducto" value="<?php  echo $producto->getIdProducto();?>">
						<input type="submit" value="Modificar" class="btn btn-success" name="modificar">
						</td>
					</tr>
				</table>
          </form>
		</article>
		<?php
		}
		else
		{
	  ?>
		<article>
			<?php
			if(isset($_GET['idproducto']) && !empty($_GET['idproducto']))
			{
				$pro = new Producto();
				
			?>
				<form action="" method="post" >
				
				
            <legend>Nombre del Producto a Modificar</legend><br>
            <select class="form-control" name="nombre">
			
				<?php
					if($pro->getIdById($_GET['idproducto']))
					{
					echo"<option value='".$pro->getNombre()."'>".$pro->getNombre()."</option>";
					}
				?>
                
            </select>
            <br>
             <input type="submit" value="Modificar" class="btn btn-success" name="buscar">
          </form>
			
			<?php
			}else
			{
			?>
			<form action="" method="post" >
				
				
            <legend>Nombre del Producto a Modificar</legend><br>
            <select class="form-control" name="nombre">
			
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
            <br>
             <input type="submit" value="Buscar" class="btn btn-success" name="buscar">
          </form>
		  <?php
			}
		  ?>
		</article>
		<?php
		}
	  ?>
		
	
	</section>
</body>
</html>
