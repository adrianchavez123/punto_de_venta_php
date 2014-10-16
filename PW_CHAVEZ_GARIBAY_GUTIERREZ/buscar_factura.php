<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	
	$con = new Conexion();
	$session = new SessionAdmin();
	$alert = new Alert();
	$session->verificar();
	
	
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
</head>

<body>
<?php
	if($con->conectar())
	{
?>
	<section>
		<h1 align="center">Buscar factura/nota</h1>
		<?php
	   
			if(isset($_POST['tipo2']))
			{
	   ?>
		<section>
		
			<form action="" method="post">
            
				<table>
					<tr>
						<td><legend>Numero de nota/factura</legend></td>
					</tr>
					<tr>
						</td>
				<?php
				
					if($_POST['tipo'] == "nota")
					{
						echo "<select name='numnota'>";
						$arreglo = $con->getNumNotaFactura(1);
						foreach($arreglo as $ar)
						{
							echo "<option value='$ar'>$ar</option>";
						}
						echo "</select>";
					}
					else if($_POST['tipo'] == "factura")
					{
						echo "<select name='numfactura'>";
						$arreglo = $con->getNumNotaFactura(2);
						foreach($arreglo as $ar)
						{
							echo "<option value='$ar'>$ar</option>";
						}
						echo "</select>";
					}
				?>
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Buscar" class="btn btn-success" name="buscar"></td>
				 </tr>
				</table>
          </form>
		</section>
		
		  <?php
	  
			}
			else if(isset($_POST['buscar']))
			{
				$sentencia;
				if(isset($_POST['numnota']) && !empty($_POST['numnota']))
				{
					echo "<h1>Nota</h1>";
					$sentencia = "select notas.idnota,usuarios.nombre,usuarios.Apaterno,ventas.producto,ventas.cantidad,ventas.precio,"
						."numventa.fecha from notas join (numventa) using (idnumventa) join (ventas) using (idnumventa) join (usuarios) using (idusuario)"
						."where notas.idnota = ".$_POST['numnota'];
				}
				else if(isset($_POST['numfactura']) && !empty($_POST['numfactura']))
				{
					echo "<h1>Factura</h1>";
					$sentencia = "select facturas.idfactura,usuarios.nombre,usuarios.Apaterno,ventas.producto,ventas.cantidad,ventas.precio,"
						."numventa.fecha from facturas join (numventa) using (idnumventa) join (ventas) using (idnumventa) join (usuarios) using (idusuario)"
						."where facturas.idfactura = ".$_POST['numfactura'];
				}
			
				//echo $sentencia;
	  ?>
		<article>
		
			<table class="table table-bordered table-striped table-hover table-condensed">
               
               <tr>
                 <th>Numero</th>
                 <th>Nombre</th>
                 <th>Apellido</th>
                 <th>Producto</th>
				 <th>Cantidad</th>
                 <th>Precio</th>
                 <th>Fecha</th>
                 
               </tr>
			   
			   <?php
					$consulta = mysql_query($sentencia,$con->con);
					
					while($reg = mysql_fetch_assoc($consulta))
					{
						echo "<tr>";
						if(isset($_POST['numnota']))
						{
							echo "<td>".$reg['idnota']."</td>";
						}
						else if (isset($_POST['numfactura']))
						{
							echo "<td>".$reg['idfactura']."</td>";
						}
						echo "<td>".$reg['nombre']."</td>";
						echo "<td>".$reg['Apaterno']."</td>";
						echo "<td>".$reg['producto']."</td>";
						echo "<td>".$reg['cantidad']."</td>";
						echo "<td>".$reg['precio']."</td>";
						echo "<td>".$reg['fecha']."</td>";
						echo "</tr>";
					}
			   ?>
                             
              </table>
		</article>
		<?php
		}
		else
		{
     ?> 
		<article>
			 <form action="" method="post">
				<table>
					<tr>
						<td><h1>Tipo de busqueda</h1></td>
					</tr>
					<tr>
						<td><h4>nota o factura</h4></td>
					</tr>
					<tr>
						<td>
							<input type="radio" name="tipo" id="tipo" value="nota"/>Nota
							<input type="radio" name="tipo" id="tipo" value="factura"/>Factura
						</td>
					</tr>
					<tr>
						<td><input type="submit" value="Buscar" class="btn btn-success" name="tipo2"></td>
					</tr>
				</table>
			  </form>
		</article>
		 <?php
		}
	  ?>
	</section>
	<?php
	
	}else
	{
		$alert->imprimir("no se pudo conectar a la base de datos",1);
	}
	?>
</body>
</html>