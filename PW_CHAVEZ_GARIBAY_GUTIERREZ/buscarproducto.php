<?php

	require_once("php/Conexion.php");
	require_once("php/Alert.php");	
	require_once("php/Session.php");
	require_once("php/Producto.php");
	$alert = new Alert();
	$con = new Conexion();
	$session = new SessionAdmin();
	
	$producto = new Producto();
	$session->verificar();
	$encontrado = false;
	if($con->conectar())
	{
		
			if(isset($_POST['buscar']) && isset($_POST['nombre']) && !empty($_POST['nombre']))
			{
				
				
				if($producto->getIdByNombre($_POST['nombre']))
				{
					
					if($producto->setCategoriaById($producto->getIdProducto()))
					{
						$encontrado = true;
					}	
				}
				else
				{
					echo "no se encontro";
				}
				
			}
	}
	else
	{
		$alert->imprimir("No se pudo conectar a la base de datos",1);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Alta Producto</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>


  <body>

    
    <section class="container">
		
		
		
		
		  <h1>Buscar un producto</h1>
			<article>
				<form action="" method="post" >
				
				<legend>Nombre del Producto a buscar</legend>
				<br>
				<select class="form-control" name="nombre">
				
					<?php
		
						$prod = $producto->getProductos();
						$i = 1;
						foreach($prod as $cat)
						{
							echo"<option value='".$cat."'>".$cat."</option>";
							$i++;
						}
					?>
					
				</select>
				<br>
				 <input type="submit" value="Buscar" class="btn btn-success" name="buscar">
			  </form>
			</article>
    
    
		<article>
		<?php
		
			if(isset($_POST['buscar']) && isset($_POST['nombre']) && !empty($_POST['nombre']) && $encontrado = true)
			{
				echo  '<table class="table">';
				echo "<tr>
					   <th>Categoria</th>
					   <th>Producto</th>
					   <th>Existencia</th>
					   <th>Precio</th>
					   <th>Imagen</th>
					 </tr>";
					 
				echo "<tr>
					   <td>".$producto->getCategoria()."</td>
					   <td>".$producto->getNombre()."</td>
					   <td>".$producto->getCantidad()."</td>
					   <td>".$producto->getPrecio()."</td>
					   <td><img class='imagenes' src='".$producto->getRutaImagen()."'></td></tr>";
				
				echo "</table>";
				
			}
		?>
		</article>
	

	</section>
	
  </body>

  </html>