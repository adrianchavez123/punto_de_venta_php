<?php

	require_once("php/Conexion.php");
	require_once("php/Alert.php");
	require_once("php/Datos.php");
	
	$con = new Conexion();
	$alert = new Alert();
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
     
		<article>
		<h1>Recordar mi cuenta</h1>

			<table>
				<form action="" method="post">
            
				<tr><td><legend>Datos</legend></td></tr>
				<tr>
					<td>
					<label>Nombre</label>
					</td>
					<td><input type="text" name="nombre"></td>
				</tr>
				<tr>
					<td>
					<label>Apellido parterno</label></td><td><input type="text" name="Apaterno"></td>
				</tr>
				<tr>
					<td>
					<label>Apellido materno</label></td><td><input type="text" name="Amaterno"></td>
				</tr>
				<tr>
				
					<td><input type="submit" value="Buscar" class="btn btn-success"></td>
				</tr>
			  </form>
			</table>
		</article>
	  <?php
	  
		if(isset($_POST['nombre']) && !empty($_POST['nombre'])
		 && isset($_POST['Apaterno']) && !empty($_POST['Apaterno'])
		 && isset($_POST['Amaterno']) && !empty($_POST['Amaterno'])
		 )
		{
			
	  ?>
      <div class="row-fluid">
        <div class="span12">
           
           <?php
				if($id = $datos->getDatosIdByNombreApellidos($_POST['nombre'],$_POST['Apaterno'],$_POST['Amaterno']))
           		{
					if($datos->getDatosPersonalesByIdDb($id))
					{
						echo "<h1>Tu nombre de usuario es</h1>";
						echo "<p class='well well-large'>".$datos->getUsername()."</p>";
           			//mail(to, subject, message)
					}
           		}
           		else
           		{
           			$alert->imprimir("Los datos ingresados no son validos",1);
           		}
           ?>
        </div>
      </div>
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