<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
    require_once("php/Datos.php");


	$con = new Conexion();
	$session = new Session();
	$alert = new Alert();
	$datos = new DatosPersonales();
	
	$session->verificar();
	$personales = true;
	$password = true;
	$domicilio = true;
	$organizacion = true;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
  </head>

	
  <body>
<?php
	if($con->conectar())
	{
        if($datos->getDatosPersonalesByIdDb($_SESSION['id']))
        {
			$datos->getDatosOrganizacionByIdDb($_SESSION['id'])
        
              
?>
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
			<br>
	<nav class="menu">
		<ul class="mi-menu">
			<li><a href="productos.php">Productos</a></li>
			<li><a href="php/cerrarSession.php">Cerrar sesion</a></li>
		</ul>
					
	</nav>
	<br>
	<br>
			
			
		</header>
		
		<article>
			 <label>los datos con (*) son obligatorios</label>
			 <table>
				<form action="" method="post">

					<tr><td>
					<legend>Datos Personales</legend>
					<hr/>			
					</td></tr>
					
					<tr>
						<td><label>Nombre *</label></td><td><input type="text" name="nombre" value="<?php  echo $datos->getNombre(); ?>" readonly="readonly"></td>
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
						<label>Apellido Paterno *</label></td><td><input type="text" name="Apaterno" value="<?php echo $datos->getApaterno();?>" readonly="readonly"></td>
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
						<label>Apellido Materno *</label></td><td><input type="text" name="Amaterno" value="<?php echo $datos->getAmaterno();?>" readonly="readonly"></td>
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
						<label>fecha de nacimiento</label></td><td><input type="date" name="fecha" value = "<?php echo $datos->getFechaNacimiento(); ?>"></td>
						<td>
						<?php
						if(isset($_POST['fecha']) && empty($_POST['fecha']))
						{
							echo "<p class='error'>No se ingreso fecha</p>";
							$personales = false;
						}
					?>
						</td>
					</tr>

            
					<tr>
						<td colspan="2"><legend>Cuenta</legend><hr/></td>
					</tr>
					<tr>
						<td><label>Username *</label></td><td><input type="text" name="username" value="<?php echo $datos->getUsername(); ?>" readonly="readonly"></td>
						<td>
						</td>
					</tr>
					
				
					
			
				
				
            
         
				<tr>
					<td colspan="2"><legend>Datos Envio</legend><hr/></td>
					
				</tr>
				
				<tr>
					<td>
					<label>Ciudad  *</label></td><td><input type="text" name="cuidad" value="<?php echo $datos->getCuidad(); ?>"></td>
					<td>
						<?php
						if(isset($_POST['cuidad']) && empty($_POST['cuidad']))
						{
							echo "<p class='error'>no se ingreso ciudad</p>";
							$domicilio = false;
						}
					?> 
					</td>
				</tr>
				
				<tr>
					<td>
					<label>Estado  *</label></td><td><input type="text" name="estado" value="<?php echo $datos->getEstado(); ?>"></td>
					<td>
					<?php
						if(isset($_POST['estado']) && empty($_POST['estado']))
						{
							echo "<p class='error'>no se ingreso estado</p>";
							$domicilio = false;
						}
					?>
					</td>
				</tr>
			
				<tr>
					<td>
						<label>Codigo postal  *</label></td><td><input type="text" name="codigo" value="<?php echo $datos->getCp(); ?>"></td>
					<td>
					<?php
						if(isset($_POST['codigo']) && empty($_POST['codigo']))
						{
							echo "<p class='error'>no se ingreso codigo postal</p>";
							$domicilio = false;
						}
					?>
					</td>
				</tr>
				<tr>
					<td>
					<label>Colonia  *</label></td><td><input type="text" name="colonia" value="<?php echo $datos->getColonia(); ?>"></td>
					<td>
					<?php
						if(isset($_POST['colonia']) && empty($_POST['colonia']))
						{
							echo "<p class='error'>no se ingreso colonia</p>";
							$domicilio = false;
						}
					?> 
					</td>
				</tr>
				<tr>
					<td>
						<label>Calle  *</label></td><td><input type="text" name="calle" value="<?php echo $datos->getCalle(); ?>"></td>
					<td>
						<?php
						if(isset($_POST['calle']) && empty($_POST['calle']))
						{
							echo "<p class='error'>no se ingreso ciudad</p>";
							$domicilio = false;
						}
					?>
					</td>
				</tr>
			
				<tr>
					<td>
				
						<label>Numero exterior *</label></td><td><input type="text" name="numeroExt" value="<?php echo $datos->getNoExterior(); ?>"></td>
					<td>
					<?php
						if(isset($_POST['noExterior']) && empty($_POST['noExterior']))
						{
							echo "<p class='error'>no se ingreso no Exterior</p>";
							$domicilio = false;
						}
					?> 
					</td>
				</tr>
			
				<tr>
					<td><label>Numero interior</label></td><td><input type="text" name="numeroInt" value="<?php echo $datos->getNoInterior(); ?>"></td>
					<td>
					
					</td>
				</tr>
			
				<input type="hidden" name="domicilio" value="Actualizar Domicilio">
       
				<tr>
					<td><label>Telefono</label></td><td><input type="tel" name="telefono" value="<?php echo $datos->getTelefono(); ?>"></td>
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
					<td><input type="email" name="email" value="<?php echo $datos->getEmail(); ?>" readonly="readonly"></td>
					<td>
					 
					</td>
				</tr>
				
				<tr>
					<td colspan="2">
					<legend>Datos Organizacion</legend>
					<hr/>
					</td>
				</tr>
				
				<tr>
					<td><label>Razon social</label></td><td><input type="text" name="razon" value="<?php echo $datos->getRazonSocial(); ?>"></td>
					<td>
					<?php
						if(isset($_POST['razon']) && empty($_POST['razon']))
						{
							echo "<p class='error'>Debes ingresar razon social</p>";
							$organizacion = false;
						}
					?>
					</td>
				</tr>
				<tr>
				
					<td><label>RFC</label></td><td><input type="text" name="rfc" value="<?php echo $datos->getRFC(); ?>"></td>
					<td>
						 <?php
						if(isset($_POST['rfc']) && empty($_POST['rfc']))
						{
							echo "<p class='error'>Debes ingresar rfc</p>";
							$organizacion = false;
						}
					?>
					</td>
				</tr>
				<input type="hidden"  name="organizacion" value="Actualizar Datos">
				<input type="hidden"  name="personales" value="Actualizar Datos">
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
				if($personales == true)
				{
					if(isset($_POST['personales']))
					{
						if($datos->updateFechaNacimiento($_POST['fecha']))
						{	
							$alert->imprimir("Tu fecha ha sido cambiada satisfactoriamente",3);
						}
						else
						{
							$alert->imprimir("No pudo modificarser tu fecha",1);
						}
					}
				}
				
				if($password = true)
				{
					if(isset($_POST['password']))
					{
						if($datos->updatePassword($_POST['nueva']))
						{	
							$alert->imprimir("Tu contraseña ha sido cambiada satisfactoriamente",2);
						}
						else
						{
							$alert->imprimir("No pudo modificarser tu contraseña",1);
						}
					}
				}
				if($domicilio = true)
				{
					if(isset($_POST['domicilio']))
					{
						if($_POST['cuidad'] != $datos->getCuidad())
						{
							if($datos->updateCuidad($_POST['cuidad']))
							{	
								$alert->imprimir("Tu cuidad ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu cuidad",1);
							}
						}
						
						if($_POST['estado'] != $datos->getEstado())
						{
							if($datos->updateEstado($_POST['estado']))
							{	
								$alert->imprimir("Tu estado ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu estado",1);
							}
						}
						if($_POST['colonia'] != $datos->getColonia())
						{
							if($datos->updateColonia($_POST['colonia']))
							{	
								$alert->imprimir("Tu colonia ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu colonia",1);
							}
						}
						if($_POST['codigo'] != $datos->getCp())
						{
							if($datos->updateCp($_POST['codigo']))
							{	
								$alert->imprimir("Tu codigo postal ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu codigo postal",1);
							}
						}
						
						if($_POST['calle'] != $datos->getCalle())
						{
							if($datos->updateCalle($_POST['calle']))
							{	
								$alert->imprimir("Tu calle ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu calle",1);
							}
						}
						
						if($_POST['numeroExt'] != $datos->getNoExterior())
						{
							if($datos->updateNoExterior($_POST['numeroExt']))
							{	
								$alert->imprimir("Tu numero exterior ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu numero",1);
							}
						}
						
						if(isset($_POST['numeroInt']) && !empty($_POST['numeroExt']))
						{
							if($_POST['numeroExt'] != $datos->getNoInterior())
							{
								if($datos->updateNoInterior($_POST['numeroExt']))
								{	
									$alert->imprimir("Tu numero interior ha sido cambiada satisfactoriamente",2);
								}
								else
								{
									$alert->imprimir("No pudo modificarser tu numero interior",1);
								}
							}
						}
						
						if(isset($_POST['telefono']) && !empty($_POST['telefono']))
						{
							if($_POST['telefono'] != $datos->getTelefono())
							{
								if($datos->updateTelefono($_POST['telefono']))
								{	
									$alert->imprimir("Tu numero telefonico ha sido cambiada satisfactoriamente",2);
								}
								else
								{
									$alert->imprimir("No pudo modificarser tu numero telefonico",1);
								}
							}
						}
					}
				}
				
				if($organizacion = true)
				{
					if(isset($_POST['organizacion']))
					{
						if($_POST['rfc'] != $datos->getRFC())
						{
							if($datos->updateRFC($_POST['rfc'],$datos->getId()))
							{	
								$alert->imprimir("Tu rfc ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu rfc",1);
							}
						}
						
						if($_POST['razon'] != $datos->getRazonSocial())
						{
							if($datos->updateRazonSocial($_POST['razon'],$datos->getId()))
							{	
								$alert->imprimir("Tu razon social ha sido cambiada satisfactoriamente",2);
							}
							else
							{
								$alert->imprimir("No pudo modificarser tu razon social",1);
							}
						}
					}
					
					
				}
			}
			else
			{
				//echo "ocurrio un error";
				$alert->imprimir("Ocurrio un error al cargar tus datos",1);
			}
			$datos->getDatosOrganizacionByIdDb($_SESSION['id']);
			
		}
		else
		{
			$alert->imprimir("No se pudo conectar a la base de datos",1);
		}
	?>
	

  </body>
</html>
