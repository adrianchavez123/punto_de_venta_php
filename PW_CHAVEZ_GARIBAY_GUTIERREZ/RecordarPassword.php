<?php

	require_once("php/Conexion.php");
	require_once("php/Alert.php");
	require_once("php/NuevaClave.php");
	require_once("php/Datos.php");

	
	$con = new Conexion();
	$alert = new Alert();
	
	$nuevaclave = new NuevaClave();
	$datos = new DatosPersonales();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Recordar mi cuelta</title>
   
    <link href="style.css" rel="stylesheet">
   
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
						<h3 class="slogan">Texto aquí</h3>
					</td>
				</tr>
			</table>
			
			
			<br>
			
			
		</header>
<?php
	if($con->conectar())
	{
?>
     
    <section class="container">
      
      	<h1>Recordar mi cuenta</h1>
      
      
	  <?php
	  
		if(isset($_POST['nombre']) && !empty($_POST['nombre'])
		 && isset($_POST['Apaterno']) && !empty($_POST['Apaterno'])
		 && isset($_POST['Amaterno']) && !empty($_POST['Amaterno'])
		 && isset($_POST['username']) && !empty($_POST['username'])
     )
		{
			
	  ?>
      
        <article>
           
           <?php
           		if($id = $datos->getDatosIdByNombreApellidos($_POST['nombre'],$_POST['Apaterno'],$_POST['Amaterno']))
           		{
					if($datos->getDatosPersonalesByIdDb($id))
					{
           			
						if($_POST['username'] = $datos->getUsername())
						{
             ?>

						  
						  <h1>Responda a la pregunta secreta</h1>
						  <hr>
						  <form action=""method="post">
							<?php
									 echo "<label>".$datos->getPreguntaSecreta()."</label>";
								  
							?>
							<br>
							<input type="hidden" name="id" value="<?php echo $datos->getId(); ?>">
							<input type="text" name="respuesta">
							<br>
							<input type="submit" class="btn btn-success btn-lage" value="enviar">
							 </form>
							
					<?php
						}else
						{
							$alert->imprimir("Los datos ingresados no son validos",1);
						}
					}
					else
					{
						$alert->imprimir("No se pudieron obtener los datos",1);
					}
                
           		}
           		else
           		{
           			$alert->imprimir("Los datos ingresados no son validos",1);
           		}
           ?>
        </article>
      
         <?php
		 }
		 else if (isset($_POST['respuesta']) && !empty($_POST['id']))
		 {
		 ?>
		 <article>
		 <?php
			$sentencia = "select * from usuarios where idUsuario='".$_POST['id']."' and RespuestaPregunta ='".$_POST['respuesta']."'";
			//echo $sentencia;
			$res = mysql_query($sentencia,$con->con);

			if($res)
			{
				$num = mysql_num_rows($res);
				$id;
				if($num == 1)
				{
					if($datos->getDatosPersonalesByIdDb($_POST['id']))
					{
						$nueva = $nuevaclave->generar();
						echo $datos->getUsername()." tu nueva contraseña es  ".$nueva;
						
						if($datos->updatePassword($nueva))
						{
							$alert->imprimir("tu contraseña ha sido modificada",2);
						}
						else
						{
							$alert->imprimir("No se pudo modificar tu contraseña intenta de nuevo",1);
						}
					}
				}
				else
				{
				  $alert->imprimir("La respuesta no es correcta",1);
				}
			}
			else
			{
			  $alert->imprimir("Ocurrio un error intente de nuevo",1);
			}
			
		?>
		</article>
		<?php
		 }
		 else
		 {
		?>
			<article>
				<table>
				  <form action="" method="post">
					<tr>
					
						<td><legend>Datos</legend></td>
					</tr>
					<tr>
						<td><label>Nombre</label></td><td><input type="text" name="nombre"></td>
					</tr>
					<tr>
						<td><label>Apellido parterno</label></td><td><input type="text" name="Apaterno"></td>
					</tr>
					<tr>
						<td><label>Apellido materno</label></td><td><input type="text" name="Amaterno"></td>
					</tr>
						<td><label>Username</label></td><td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td><input type="submit" value="Buscar" class="btn btn-success">
						</td>
					</tr>
				  </form>
				</table>
		  </article>
      <?php
        }
      ?>
    </section>

	<?php
	}
	else
	{
		$alert->imprimir("no se pudo conectar a la base de datos",1);
	}
	?>

	<footer>
			<h3 id="foot">Mi direccion &nbsp || &nbsp Mi telefóno &nbsp || &nbsp mi email</h3>
		</footer>
  </body>

  </html>