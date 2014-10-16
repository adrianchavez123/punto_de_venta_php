<?php

	require_once("php/Conexion.php");
	require_once("php/Session.php");
	require_once("php/Alert.php");
	require_once("php/Producto.php");
	
	$con = new Conexion();
	$session = new SessionAdmin();
	$alert = new Alert();
	$session->verificar();
	$pro = new Producto();
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
	<h1 align="center">Buscar Articulo</h1>
	<?php
	  
		if(isset($_POST['buscar']) && isset($_POST['tipo']) && !empty($_POST['tipo']))
		{
		
	  ?>
	<section>
	
		<form name="form" id="form" method="post" action="">
			
			<?php echo $_POST['tipo']; ?>
			<br>
			<?php  
			
				if($_POST['tipo'] == "nombre")
				{
					echo "<select name='nombre'>";
					
	
					$prod = $pro->getProductos();
					$i = 1;
					foreach($prod as $cat)
					{
						echo"<option value='".$cat."'>".$cat."</option>";
						$i++;
					}
			
					echo "</select>";
				}
				else
				{
					echo "<select name='cat'>";
					
	
					$prod = $con->getCategorias();
					$i = 1;
					foreach($prod as $cat)
					{
						echo"<option value='".$i."'>".$cat."</option>";
						$i++;
					}
			
					echo "</select>";
				}
			
			?>
			
			<input type="submit" value="Buscar" class="btn btn-success" name="busqueda"> 
		</form>
	</section>
	<?php
		}
		else if(isset($_POST['busqueda']))
		{
	  ?>
	<article>
	
		<table class="table table-bordered table-striped table-hover table-condensed">
               
               <tr>
                 <th>Id</th>
                 <th>Nombre</th>
                 <th>Cantidad</th>
                 <th>Precio</th>
                 
               </tr>
               <?php
					if(isset($_POST['nombre']))
					{
						$sentencia = "select * from productos where estado = 1 and nombre='".$_POST['nombre']."'";
					}
					else
					{
						$sentencia = "select * from productos where estado = 1 and idcategoria=".$_POST['cat'];
					}
					$con->setTablaProductos($sentencia);
			   ?>

                
              </table>
	</article>
	  <?php
		}
		else
		{
	  ?>
		<form action="" method="post">
            
			<table>
				<tr>
				<td><legend>Tipo de busqueda</legend></td>
				</tr>
				<tr>
					<td><label>Nombre</label></td>
				
					<td>
						<select name="tipo">
						  <option value="categoria">categoria</option>
						  <option value="nombre">nombre</option>
						</select>
					</td>
				</tr>
				<tr>
				 <td><input type="submit" value="Buscar" class="btn btn-success" name="buscar"></td>
				</tr>
			 </table>
          </form>
	<?php
		}
	?>
<?php
	}
	else
	{
		$alert->imprimir("No se pudo conectar al servidor de base de datos",1);
	}
?>
</body>

</html>