<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	require_once("php/Datos.php");
	
	$con = new Conexion();
	$session = new Session();
	$session = new Session();
	$sentencia;
	$datos = new DatosPersonales();
	$alert = new Alert();
	
	$continuar = true;
	
		
		
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
  </head>

	<?php
	if($con->conectar())
	{
	?>
  <body>

    <section id="contenedor">
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
			if(isset($_POST['envio']) && $continuar == true)
			{
				echo "<h1>Bienvenido</h1>";
				echo "<a href='productos.php'>ir a inicio</a>";
			}
		?>
		<article>
			 <label>los datos con (*) son obligatorios</label>
			 <table>
				<form action="" method="post">

					<tr><td>
					<legend>Datos Personales</legend>
					<hr/>			
					</td></tr>
					
					<tr>
						<td><label>Nombre *</label></td><td><input type="text" name="nombre"></td>
						<td>
						<?php if(isset($_POST['nombre']) && empty($_POST['nombre']))
						{
							$continuar=false;echo "<p class='error'>No se ingreso nombre</p>";
						}
						else if(isset($_POST['nombre']) && !empty($_POST['nombre']))
						{
							$datos->setNombre($_POST['nombre']);
						}		
						?> 
						</td>
					</tr>
					
					<tr>
						<td>
						<label>Apellido Paterno *</label></td><td><input type="text" name="Apaterno"></td>
						<td>
						<?php if(isset($_POST['Apaterno']) && empty($_POST['Apaterno']))
						{ 
							$continuar=false;echo "<p class='error'>No se ingreso apellido paterno</p>";
						}
						else if(isset($_POST['Apaterno']) && !empty($_POST['Apaterno']))
						{
							$datos->setApaterno($_POST['Apaterno']);
						}
						?>
						</td>
					</tr>
					
					
					<tr>
						<td>
						<label>Apellido Materno *</label></td><td><input type="text" name="Amaterno"></td>
						<td>
						<?php if(isset($_POST['Amaterno']) && empty($_POST['Amaterno']))
							{
								$continuar=false;echo "<p class='error'>No se ingreso apellido materno</p>";
							}
							else if(isset($_POST['Amaterno']) && !empty($_POST['Amaterno']))
							{
								$datos->setAmaterno($_POST['Amaterno']);
							}
						?> 
						</td>
					</tr>
			
					<tr>
						<td>
						<label>fecha de nacimiento</label></td><td><input type="date" name="fecha"></td>
						<td>
						<?php
							if(isset($_POST['fecha']) && !empty($_POST['fecha']))
							{
								$datos->setFechaNacimiento($_POST['fecha']);
							}
						?>
						</td>
					</tr>

            
					<tr>
						<td colspan="2"><legend>Cuenta</legend><hr/></td>
					</tr>
					<tr>
						<td><label>Username *</label></td><td><input type="text" name="username"></td>
						<td>
						<?php if(isset($_POST['username']) && empty($_POST['username'])){ 
						$continuar=false;echo "<p class='error'>No se ingreso nombre de usuario</p>";
				}
				if(isset($_POST['username']) && !empty($_POST['username']))
				{	
					$x = $con->selectUser("select * from usuarios where username='".$_POST['username']."'");
				
					if($x == 0)
					{
						$datos->setUsername($_POST['username']);
					}else
					{
						$continuar=false;
						echo "<p class='error'>El usuario ya existe</p>";
				
					}
				}
				
			?>
						</td>
					</tr>
					
				
						<td><label >Password *</label></td><td><input type="password" name="password"></td>
						<td>
							<?php if(isset($_POST['password']) && empty($_POST['password'])){
								$continuar=false;echo "<p class='error'>No se ingreso contraseña</p>";
								}
								if(isset($_POST['password']) && !empty($_POST['password'])
									&& isset($_POST['password2']) && !empty($_POST['password2'])
								)
								{
									if($_POST['password'] == $_POST['password2'])
									{
										$datos->setPassword($_POST['password']);
									}else
									{
										$continuar = false;
										echo "<p class='error'>Las contraseñas no coinciden</p>";
									}
								}
							?> 
						</td>
					</tr>
					
					<tr>
						<td><label >Repetir Password *</label></td><td><input type="password" name="password2"></td>
						<td>
						<?php if(isset($_POST['password2']) && empty($_POST['password2'])){ $continuar=false;echo "<p class='error'>No se ingreso confirmacion de contraseña</p>";} ?> 
            
						</td>
					</tr>
			
				<tr>
					<td>
						<label >Pregunta secreta *</label></td><td><input type="text" name="pregunta"></td>
					<td>
					<?php if(isset($_POST['pregunta']) && empty($_POST['pregunta']))
						{
							$continuar=false;echo "<p class='error'>No se ingreso pregunta</p>";
						}
						else if(isset($_POST['pregunta']) && !empty($_POST['pregunta']))
						{
							$datos->setPreguntaSecreta($_POST['pregunta']);
						}
					?> 
					</td>
				</tr>
				<tr>
					<td>
						<label >Respuesta a la pregunta *</label></td><td><input type="text" name="respuesta"></td>
					<td>
					<?php if(isset($_POST['respuesta']) && empty($_POST['respuesta']))
						{
							$continuar=false;echo "<p class='error'>No se ingreso respuesta</p>";
						}
						else if(isset($_POST['respuesta']) && !empty($_POST['respuesta']))
						{
							$datos->setRespuestaPregunta($_POST['respuesta']);
						}
					?> 
					</td>
				</tr>
            
         
				<tr>
					<td colspan="2"><legend>Datos Envio</legend><hr/></td>
					
				</tr>
				
				<tr>
					<td>
					<label>Ciudad  *</label></td><td><input type="text" name="cuidad"></td>
					<td>
						<?php if(isset($_POST['cuidad']) && empty($_POST['cuidad']))
							{
								$continuar=false;echo "<p class='error'>No se ingreso ciudad</p>";
							}
							else  if(isset($_POST['cuidad']) && !empty($_POST['cuidad']))
							{
								$datos->setCuidad($_POST['cuidad']);
							}
						?> 
					</td>
				</tr>
				
				<tr>
					<td>
					<label>Estado  *</label></td><td><input type="text" name="estado"></td>
					<td>
					<?php if(isset($_POST['estado']) && empty($_POST['estado']))
				{ 
					$continuar=false;echo "<p class='error'>No se ingreso estado</p>";
				} 
				 else if(isset($_POST['estado']) && !empty($_POST['estado']))
				{
					$datos->setEstado($_POST['estado']);
				}
			?>
					</td>
				</tr>
			
				<tr>
					<td>
						<label>Codigo postal  *</label></td><td><input type="text" name="codigo"></td>
					<td>
					<?php if(isset($_POST['codigo']) && empty($_POST['codigo']))
						{
							$continuar=false;echo "<p class='error'>No se ingreso codigo</p>";
						}
						else if(isset($_POST['codigo']) && !empty($_POST['codigo']))
						{
							$datos->setCp($_POST['codigo']);
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
					<label>Colonia  *</label></td><td><input type="text" name="colonia"></td>
					<td>
					<?php if(isset($_POST['colonia']) && empty($_POST['colonia']))
						{ 
							$continuar=false;echo "<p class='error'>No se ingreso colonia</p>";
						}
						else if(isset($_POST['colonia']) && !empty($_POST['colonia']))
						{
							$datos->setColonia($_POST['colonia']);
						}
					?> 
					</td>
				</tr>
				<tr>
					<td>
						<label>Calle  *</label></td><td><input type="text" name="calle"></td>
					<td>
					<?php if(isset($_POST['calle']) && empty($_POST['calle']))
						{ 
							$continuar=false;echo "<p class='error'>No se ingreso calle</p>";
						}
						else if(isset($_POST['calle']) && !empty($_POST['calle']))
						{
							$datos->setCalle($_POST['calle']);
						}
						?> 
					</td>
				</tr>
			
				<tr>
					<td>
				
						<label>Numero exterior *</label></td><td><input type="text" name="numeroExt"></td>
					<td>
					<?php if(isset($_POST['numeroExt']) && empty($_POST['numeroExt']))
						{
							$continuar=false;echo "<p class='error'>No se ingreso numero</p>";
						}
						else if(isset($_POST['numeroExt']) && !empty($_POST['numeroExt']))
						{
							$datos->setNoExterior($_POST['numeroExt']);
						}
					?> 
					</td>
				</tr>
			
				<tr>
					<td><label>Numero interior</label></td><td><input type="text" name="numeroInt"></td>
					<td>
					<?php
						 if(isset($_POST['numeroInt']) && !empty($_POST['numeroInt']))
						{
							$datos->setNoInterior($_POST['numeroInt']);
						}
					?>
					</td>
				</tr>
			
				<tr>
					<td><label>Telefono</label></td><td><input type="tel" name="telefono"></td>
					<td>
						<?php
							 if(isset($_POST['telefono']) && !empty($_POST['telefono']))
							{
								$datos->setTelefono($_POST['telefono']);
							}
						?>
					</td>
				</tr>
			
				<tr>
					<td><label>Correo electronico  *</label></td>
					<td><input type="email" name="email"></td>
					<td>
					<?php if(isset($_POST['email']) && empty($_POST['email'])){ 
						$continuar=false;echo "<p class='error'>No se ingreso correo electronico</p>";
						}
						if(isset($_POST['email']) && !empty($_POST['email']))
						{ 
							$y = $con->selectUser("select * from usuarios where email='".$_POST['email']."'");
							if($y == 0)
							{
								$datos->setEmail($_POST['email']);
							}else
							{
								$continuar=false;
								echo "<p class='error'>ya existe un usuario con ese correo</p>";
							}
						}
					?> 
					</td>
				</tr>
				
				<tr>
					<td colspan="2">
					<legend>Datos Organizacion</legend>
					<hr/>
					</td>
				</tr>
				
				<tr>
					<td><label>Razon social</label></td><td><input type="text" name="razon"></td>
					<td>
					<?php
						 if(isset($_POST['razon']) && !empty($_POST['razon']))
						{
							$datos->setRazonSocial($_POST['razon']);
						}
					?>
					</td>
				</tr>
				<tr>
				
					<td><label>RFC</label></td><td><input type="text" name="rfc"></td>
					<td>
						<?php
							 if(isset($_POST['rfc']) && !empty($_POST['rfc']))
							{
								$datos->setRFC($_POST['rfc']);
							}
						?>
					</td>
				</tr>
         
				<tr>
					<td colspan="2"><input type="submit" value="Registrarme"  name="envio">
					</td>
				</tr>
			</form>
			 </table>
		</article>
		
	<section class="contenido">
         
	<footer>
			<h3 id="foot">Mi direccion &nbsp || &nbsp Mi telefóno &nbsp || &nbsp mi email</h3>
		</footer>
	
	</section>

	<?php
	
		if(isset($_POST['envio'])){
		
			if($continuar == true)
			{	
				if($datos->insertDatosPersonales())
				{
					$alert->imprimir("Tus datos han sido capturados",3);
					$sentencia = "select idUsuario from usuarios where username='".$datos->getUsername()."' and password= '".md5($datos->getPassword())."'";
					$id;
					$reg = mysql_query($sentencia,$con->con);
					if($reg)
					{
						while($res = mysql_fetch_assoc($reg))
						{
							$id = $res['idUsuario'];
						}
					}
					//echo "<h1>id".$id."</h1>";
					$datos->insertDatosOrganizacion($id);
					$session->start($id);
				}
				else
				{
					$alert->imprimir("No se pudo insertar tu informacion",1);
				}
			}
		}
	}else
	{
		$alert->imprimir("La pagina actual no esta disponible",1);
	}
	?>
	

  </body>
</html>
