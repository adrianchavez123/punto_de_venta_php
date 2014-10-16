<?php

	require_once("Conexion.php");
	require_once("Subir.php");
	class Categoria
	{
		var $categoria;//nombre
		var $con;
		var $subir;
		public function __construct()
		{
			$this->con = new Conexion();
			$this->subir = new Subir();
			if($this->con->conectar())
			{
			}else
			{
				echo "error";
			}
		
		}
		public function setCategoriaById($id)
		{
			$sentencia = "select nombre from categorias where idCategoria=".$id;
			$reg = mysql_query($sentencia,$this->con->con);
			//echo $sentencia;
			if($reg)
			{
				$num = mysql_num_rows($reg);
				if($num == 1)
				{
					while($r = mysql_fetch_assoc($reg))
					{
						$this->categoria = $r['nombre'];
					}
					return true;
				}else
				{
					return false;
				}
				
			}
			else
			{
				return false;
			}
			
		}
		public function getCategoria()
		{
			return $this->categoria;
		}
		public function setCategoria($categoria)
		{
			$this->categoria = $categoria;
		}
		
		public function createCategoria()
		{
			$sentencia = "insert into categorias (nombre)values(".
				"'".$this->categoria."')";
			
			if($this->con->insert($sentencia))
			{
				return true;
			}else
			{
				return false;
			}			
		}
	}
	
	class Producto extends Categoria
	{
		protected $IdProducto,$Idcategoria,$nombre,$cantidad,$precio,$estado;
		protected $rutaImagen;
		protected $idnumventa;
		
		public function getIdProducto()
		{
			return $this->IdProducto;
		}
		
		public function getIdCategoria()
		{
			return $this->Idcategoria;
		}
		
		public function getNombre()
		{
			return $this->nombre;
		}
		
		public function getCantidad()
		{
			return $this->cantidad;
		}
		
		public function getPrecio()
		{
			return $this->precio;
		}
		
		public function getEstado()
		{
			return $this->estado;
		}
		
		public function getRutaImagen()
		{
			return $this->rutaImagen;
		}
		
		public function setIdProducto($IdProducto)
		{
			$this->IdProducto = $IdProducto;
		}
		
		public function setIdCategoria($Idcategoria)
		{
			$this->Idcategoria = $Idcategoria;
		}
		
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}
		
		public function setCantidad($cantidad)
		{
			$this->cantidad = $cantidad;
		}
		
		public function setPrecio($precio)
		{
			$this->precio = $precio;
		}
		
		public function setEstado($estado)
		{
			$this->estado = $estado;
		}
		
		public function setRutaImagen($rutaImagen)
		{
			$this->rutaImagen = $rutaImagen;
		}
		
		public function createProducto()
		{
			$this->rutaImagen = $this->subir->upload($this->nombre);
			
			$sentencia = "insert into productos(idcategoria,nombre,cantidad,precio,estado,rutaImagen)"
				."values ("
				.$this->Idcategoria.","
				."'".$this->nombre."',"
				.$this->cantidad.","
				.$this->precio.","
				."1,"
				."'".$this->rutaImagen."')";
			
			//echo $sentencia;
			
			return ($this->con->insert($sentencia));
		}
		
		public function getIdByNombre($nombre)
		{
			$sentencia = "select * from productos where nombre='".$nombre."' and estado = 1";
			//echo $sentencia;
			$reg = mysql_query($sentencia,$this->con->con);
			
			if($reg)
			{
				if(mysql_num_rows($reg) == 1)
				{
					while($v = mysql_fetch_assoc($reg))
					{
						$this->IdProducto = $v['IdProducto'];
						$this->Idcategoria= $v['Idcategoria'];
						$this->nombre= $v['nombre'];
						$this->precio= $v['precio'];
						$this->cantidad= $v['cantidad'];
						$this->rutaImagen= $v['rutaImagen'];
						$this->estado = $v['estado'];
					}
				}
				return true;
			}
			return false;
		}
		
		public function getById($id)
		{
			$sentencia = "select * from productos where idProducto=".$id." and estado = 1";
			//echo $sentencia;
			$reg = mysql_query($sentencia,$this->con->con);
			
			if($reg)
			{
				if(mysql_num_rows($reg) == 1)
				{
					while($v = mysql_fetch_assoc($reg))
					{
						$this->IdProducto = $v['IdProducto'];
						$this->Idcategoria= $v['Idcategoria'];
						$this->nombre= $v['nombre'];
						$this->precio= $v['precio'];
						$this->cantidad= $v['cantidad'];
						$this->rutaImagen= $v['rutaImagen'];
						$this->estado = $v['estado'];
					}
				}
				return true;
			}
			return false;
		}
		
		public function updateNombre($nuevo)
		{
			if($nuevo != $this->nombre)
			{
				$sentencia = "update productos set nombre = '".$nuevo."' where IdProducto = ".$this->IdProducto; 
				//echo $sentencia;
				return ($this->con->insert($sentencia));
				
			}
			return true;
		}
		
		public function updateCantidad($nuevo)
		{
			if($nuevo != $this->cantidad)
			{
				$sentencia = "update productos set cantidad = ".$nuevo." where IdProducto = ".$this->IdProducto; 
				return ($this->con->insert($sentencia));
				
			}
			return true;
		}
		
		public function updatePrecio($nuevo)
		{
			if($nuevo != $this->precio)
			{
				$sentencia = "update productos set precio = ".$nuevo." where IdProducto = ".$this->IdProducto; 
				return ($this->con->insert($sentencia));
				
			}
			return true;
		}
		
		public function updateEstado($nuevo)
		{
			if($nuevo != $this->estado)
			{
				$sentencia = "update productos set estado = ".$nuevo." where IdProducto = ".$this->IdProducto; 
				//echo $sentencia;
				return ($this->con->insert($sentencia));
				
			}
			return true;
		}
		
		public function updateRutaImagen($nuevo)
		{
			return false;
		}
		
		
		public function getProducto($nombre)
		{
			$sentencia = "select * from productos where nombre='".$nombre."' and estado = 1";
			$productoArray = array();
			
			$reg = mysql_query($sentencia,$this->con->con);
			if($reg)
			{
				if(mysql_num_rows($reg) == 1)
				{
					while($v = mysql_fetch_assoc($reg))
					{
					
						$productoArray['Idproducto'] = $v['IdProducto'];
						$productoArray['Idcategoria']=$v['Idcategoria'];
						$productoArray['nombre']=$v['nombre'];
						$productoArray['cantidad']=$v['cantidad'];
						$productoArray['precio']=$v['precio'];
						$productoArray['rutaImagen']=$v['rutaImagen'];
						
					
					}
					
					return $productoArray;
				}
				else
				{
					return 0;
				}
			}
		}
		
		public function getProductos()
		{
			$sentencia = "select nombre from productos where estado = 1";
			$categorias = array();
			$consulta = mysql_query($sentencia,$this->con->con);
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
		
		public function getNota($idnumventa)
		{
			$this->idnumventa = $idnumventa;
			$sentencia = "select idNota from notas where idnumventa=".$this->idnumventa;
			
			$consulta = mysql_query($sentencia,$this->con->con);
			$id;
			if($consulta)
			{
				while($reg = mysql_fetch_assoc($consulta))
				{
					$id = $reg['idNota'];
				
				
				}
				
				return $id;
			}
			else
			{
				return 0;
			}
		}
		
		public function getFactura($idnumventa)
		{
			$this->idnumventa = $idnumventa;
			$sentencia = "select idFactura from facturas where idnumventa=".$this->idnumventa;
			
			$consulta = mysql_query($sentencia,$this->con->con);
			$id;
			if($consulta)
			{
				while($reg = mysql_fetch_assoc($consulta))
				{
					$id = $reg['idFactura'];
				
				
				}
				
				return $id;
			}
			else
			{
				return 0;
			}
		}
		
		public function getProductosNota($id)
		{
		
			$sentencia = "select producto,cantidad,precio"
						." from ventas"
						." where idnumventa = ".$id;
			$arreglo = array('producto' => array(),'cantidad' => array(),'precio' => array());
			$consulta = mysql_query($sentencia,$this->con->con);
			//echo $sentencia;
			if($consulta)
			{
				while($reg = mysql_fetch_assoc($consulta))
				{
					$arreglo['producto'][] = $reg['producto'];
					$arreglo['precio'][] = $reg['precio'];
					$arreglo['cantidad'][] = $reg['cantidad'];
					
					
				}
				
				return $arreglo;
			}
			else
			{
				return false;
			}
		}
		
		
	}
?>














