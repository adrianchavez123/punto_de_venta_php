<?php
	
	class Conexion
	{
		var $servidor = "localhost";
		var $usuario = "root";
		var $password = "1234";
		public $con;
		var $db = "materiales";
		public function conectar()
		{
			if($this->con = mysql_connect($this->servidor,$this->usuario,$this->password))
			{
				if(mysql_select_db($this->db,$this->con))
				{
					//echo "conectado";
					//return $this->con;
					return true;
				}
				else
				{
					echo "error";
					return false;
				}
			}
			else
			{
				echo "error";
				return false;
			}
		}
		
		
		public function insert($sentencia)
		{
			if(mysql_query($sentencia,$this->con))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		
		public function selectUser($sentencia)
		{
			$reg = mysql_query($sentencia,$this->con);
			
			if($reg)
			{
				$num = mysql_num_rows($reg);
				$id;
				if($num > 0)
				{
					while($res = mysql_fetch_assoc($reg))
					{	
						$id = $res['idUsuario'];
					}
					return $id;
				}
				else
				{	//echo "error  1";
					return 0;
				}
				
			}
			else
			{
				//echo "error  2";
				return false;
			}
		}
		
		public function selectAdmin($sentencia)
		{
			$reg = mysql_query($sentencia,$this->con);
			
			if($reg)
			{
				$num = mysql_num_rows($reg);
				
				if($num == 1)
				{
						return true;
				}
				else
				{	//echo "error  1";
					return 0;
				}
				
			}
			else
			{
				//echo "error  2";
				return false;
			}
		}
		
		public function getCategorias()
		{
			$sentencia = "select nombre from categorias";
			$categorias = array();
			$consulta = mysql_query($sentencia,$this->con);
			if($consulta)
			{
				while($reg = mysql_fetch_assoc($consulta))
				{
					$categorias[] = $reg['nombre'];
				
				
				}
				
				return $categorias;
			}
			else
			{
				return false;
			}
		}
		
		
		
		public function getNumNotaFactura($i)
		{
			$sentencia;
			$arreglo = array();
			if($i == 1)
			{
				//nota
				$sentencia = "select idnota from notas";
			}
			else if($i == 2)
			{	
				$sentencia = "select idfactura from facturas";
			}
			$consulta = mysql_query($sentencia,$this->con);
			
			while($reg = mysql_fetch_array($consulta))
			{
				if($i == 1)
				{
					$arreglo[] = $reg["idnota"];
					//echo $reg['idnota'];
				}else
				{
					$arreglo[] = $reg["idfactura"];
				}
				
			}
			return $arreglo;
		}
		
		public function setTablaProductos($sentencia)
		{
			
			$consulta = mysql_query($sentencia,$this->con);
			
			while($x = mysql_fetch_assoc($consulta))
			{
				echo "<tr>";
				echo "<td>".$x['nombre']."</td>";
				echo "<td>"."<img id = 'imagenes' src ='".$x['rutaImagen']."'>"."</td>";
				echo "<td>".$x['precio']."</td>";
				echo "<td>".$x['cantidad']."</td>";
			}
		}
		
	
		
		
		
		
		
		
		
		
		
		
		
	}
?>