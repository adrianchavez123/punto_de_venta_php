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
	
		if(isset($_POST['ok']))
		{
			//var_dump($_POST);
			
			if($producto->getIdById($_POST['id']))
			{
				//echo $producto->getNombre();
				if(!empty($_POST['radio']))
				{
					if($_POST['radio'] == "eliminar")
					{
						if($producto->updateEstado(0))
						{
							$alert->imprimir("Producto Eliminado",2);
						}
						else
						{
							$alert->imprimir("No se pudo eliminar",1);
						}
					}
					else if ($_POST['radio'] == "modificar")
					{
						header("location:Modificar_precio.php?idproducto=".$_POST['id']);
					}
				}
				else
				{
					$alert->imprimir("Selecccione una opcion",1);
				}
			}
			else
			{
				$alert->imprimir("Ocurrio un error",1);
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
	<title>Modificar producto</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>


<section>
		
			<form action="" name="admin" id="admin" method="post" >

				<table class="table table-bordered table-striped table-hover table-condensed">
         
					 <tr>
					   <th>Producto</th>
					   <th>Foto</th>
					   <th>Precio</th>
					   <th>Existencia</th>
					   <th>Editar</th>
					 </tr>
				<?php
	
			
			
			$sentencia = '
				SELECT
				IdProducto,nombre,rutaImagen,precio,cantidad
				FROM
				productos
				where 
				estado = 1';
				
			
			$result = mysql_query($sentencia,$con->con);
			while($x = mysql_fetch_array($result))
			{
				echo "<tr>";
				echo "<td>".$x['nombre']."</td>";
				echo "<td>"."<img id = 'imagenes' src ='".$x['rutaImagen']."'>"."</td>";
				echo "<td>".$x['precio']."</td>";
				echo "<td>".$x['cantidad']."</td>";
				echo "<td>"."<input type='radio' name='id' value='".$x['IdProducto']."'>"."</td>";
				
				echo "</tr>";
			}
			
		?>

          
        </table>
		
		
					<table>
						<tr>
							<td><label>
							<input type="radio" value="modificar" name="radio"/>Modificar Producto
						  </label></td>
						</tr>
						<tr>
							<td><label>
							<input type="radio" value="eliminar" name="radio"/>Eliminar Producto
							</label></td>
						</tr>
						<tr>
							<td><input type="submit" value="Ok" name="ok"></td>
						</tr>
				</table>
			</form>
			
		</section>
</body>
</html>