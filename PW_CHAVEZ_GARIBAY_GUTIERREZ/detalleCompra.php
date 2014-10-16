<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	require_once("php/Venta.php");
	require_once("php/Producto.php");
	require_once("php/Zebra_Pagination.php");
	require_once('php/GenerarPdf.php');
	require_once("php/validar.php");
	$con = new Conexion();
	$session = new Session();
	$alert = new Alert();
	$venta = new Venta();
	$pagination = new Zebra_Pagination();
	$idnumventa;
	$session->verificar();
	
	$val = new Validar();
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Productos</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<script type="text/javascript" src="js/validar.js"></script>
</head>



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
	echo "<input type='hidden' value='".$val->val()."' id='rfc' name='rfc'>";
	if($con->conectar())
	{
		
		if(isset($_POST['comp']))
		{
			//var_dump($_POST);
			/*foreach($_POST['cantidad'] as $id => $val)
			{
				echo "idproducto == $id cantidad = $val<br>";
			}*/
			$venta->setIdUsuario($_SESSION['id']);
			$fechaActual=date("Y/m/d");
			//echo $fechaActual;
			$venta->setFecha($fechaActual);
			$idnumventa = $venta->createNumVenta();
			if($idnumventa !=0)
			{
				foreach($_POST['cantidad'] as $id => $val)
				{
					//echo "idproducto == $id cantidad = $val<br>";
					$ventaArticulo = new Venta();
					$producto = new Producto();
					
					if($producto->getById($id))
					{
						$ventaArticulo->setIdNumVenta($idnumventa);
						$ventaArticulo->setProducto($producto->getNombre());
						$ventaArticulo->setCantidad($val);
						$ventaArticulo->setPrecio($producto->getPrecio());
						
						if($ventaArticulo->createVenta())
						{
							$producto->updateCantidad(($producto->getCantidad() - $val));
						}
						else
						{
							$alert->imprimir("Ocurrio no se pudo realizar la venta",1);
							break;
						}
					}else
					{
						$alert->imprimir("Ocurrio un error no se pudo encontrar un producto",1);
						break;
					}
				}
				$alert->imprimir("Su compra fue exitosa",3);
				
				if(isset($_POST['radio']) && !empty($_POST['radio']))
				{
					if($_POST['radio'] == "nota")
					{
						if($venta->createNota())
						{
							header('location:php/detalle2.php?idnumventa='.$idnumventa);
							exit;
						}
						else
						{
							$alert->imprimir("No se pudo crear la factura",1);
						}
					}
					else if($_POST['radio'] == "factura")
					{
						if($venta->createFactura())
						{
							
							header('location:php/detalle.php?idnumventa='.$idnumventa);
							exit;
						}
						else
						{
							$alert->imprimir("No se pudo crear la factura",1);
						}
					}
				}
			}
			else
			{
				$alert->imprimir("No se pudo realizar la compra",1);
			}
		}
	?>
     
    <article class="container">
	
	
      <form action="" method="post">
        <table class="table table-bordered table-striped table-hover table-condensed">
         
         <tr>
           <th>Producto</th>
           <th>Foto</th>
           <th>Precio</th>
           <th>Existencia</th>
           <th>Cantidad</th>
           <th>Seleccionar</th>
         </tr>
         <?php
		 
			if(isset($_POST["pedido"]))
			{
				foreach($_POST['comprar'] as $id=>$val)
				{
					//echo "id producto : $id seleccionado $val<br>";
					$sentencia = "select IdProducto,nombre,rutaImagen,precio,cantidad from productos where IdProducto=$id";
					//echo $sentencia."<br>";
					$res = mysql_query($sentencia,$con->con);
					
					if($res)
					{
						
						while($x = mysql_fetch_array($res))
						{
							if($x['cantidad'] >= $_POST['cantidad']["$id"] )
							{
								echo "<tr>";
								echo "<td>".$x['nombre']."</td>";
								echo "<td>".'<img class="imagenes2" src ="'.$x['rutaImagen'].'">'."</td>";
								echo "<td>".$x['precio']."</td>";
								echo "<td>".$x['cantidad']."</td>";
								
								echo "<td>".$_POST['cantidad']["$id"]."</td>";
								echo "<td><input type='checkbox' id='nombre' name='compra['".$x['IdProducto']."']></td></tr>";
								echo "<input type='hidden' name= cantidad[".$x['IdProducto']."] value=".$_POST['cantidad']["$id"].">";
							}
						}
						
					}
					else
					{
						$alert->imprimir("Ocurrio un error",2);
					}
				}
			}
			
		 ?>

          
        </table>
		
			
			<table>
					<tr>
						<td>
						  <label>
							<input type="radio" name="radio" id="radio" value="nota"/>Generar Nota
						  </label>
						  <label>
							<input type="radio" name="radio" id="radio" value="factura" onClick="datosCompletos();"/>Generar Factura
						  </label>
					
			
							<input type="button" value="Cancelar producto" class="btn btn-warning btn-large">
							
					  </td>
				  </tr>
				  <tr>
					<td colspan="2">
					<input type="submit" value="Comprar" class="btn btn-success btn-large" name="comp">
					</td>
				  </tr>
			</table>
			<br>
		
	   
       </form>
    </article>
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