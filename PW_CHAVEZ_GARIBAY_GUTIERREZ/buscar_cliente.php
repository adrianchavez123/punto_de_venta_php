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
	<h1 align="center">Buscar Cliente</h1>
	<section>
	
		<form name="form" id="form" method="post" action="">
			<table align="center">
				<tr>
					<td>El nombre del cliente </td>
					<td>
						<input type="text" name="nombre" id="nombre"/>						
					</td>
				
				</tr>
				<tr>
					<td>Apellido parterno </td>
					<td>
						<input type="text" name="Apaterno" id="Apaterno"/>						
					</td>
				
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="Envio"/>
					</td>
					
				</tr>
			</table>
		</form>
	</section>
	
	 <?php
	  
		if(isset($_POST['nombre']) && !empty($_POST['nombre'])
		 && isset($_POST['Apaterno']) && !empty($_POST['Apaterno']))
		{
			$sentencia = "select usuarios.nombre,usuarios.Apaterno,usuarios.colonia,usuarios.calle,usuarios.noExterior,usuarios.telefono,"
				."usuarios.cuidad,usuarios.estado,datosorganizacion.razonSocial,datosorganizacion.RFC"
				." from usuarios join (datosorganizacion) using (idUsuario) where usuarios.nombre like '%"
				.$_POST['nombre']."%' and usuarios.Apaterno  like '%".$_POST['Apaterno']."%' order by usuarios.Apaterno";
				
				//echo $sentencia;
	  ?>
	<article>
	
		<table class="table table-bordered table-striped table-hover table-condensed">
               
               <tr>
                 <th>Nombre</th>
                 <th>Apellido</th>
                 <th>Colonia</th>
                 <th>Calle</th>
                 <th>Numero</th>
				 <th>Telefono</th>
                 <th>Cuidad</th>
				 <th>Estado</th>
				 <th>RazonSocial</th>
				 <th>RFC</th>
				 
               </tr>
			<?php
			
				$consulta = mysql_query($sentencia,$con->con);
				
				if($consulta)
				{
					$num = mysql_num_rows($consulta);
					
					if($num == 0)
					{
						$alert->imprimir("No se encontro algun registro o los datos de la organizacion no estan completos ",2);
					}
					else
					{
						
						while($reg = mysql_fetch_assoc($consulta))
						{
							echo "<tr>";
							echo "<td>".$reg['nombre']."</td>";
							echo "<td>".$reg['Apaterno']."</td>";
							echo "<td>".$reg['colonia']."</td>";
							echo "<td>".$reg['calle']."</td>";
							echo "<td>".$reg['noExterior']."</td>";
							echo "<td>".$reg['telefono']."</td>";
							echo "<td>".$reg['cuidad']."</td>";
							echo "<td>".$reg['estado']."</td>";
							echo "<td>".$reg['razonSocial']."</td>";
							echo "<td>".$reg['RFC']."</td>";
							echo "</tr>";
						}
					}
				}
			?>
               

                
              </table>
	</article>
	
	<?php
		}
	}
	else
	{
		$alert->imprimir("no se pudo conectar a la base de datos",1);
	}
	?>
</body>
</html>