<?php

	require_once("Conexion.php");
	
	class NoVenta
	{
		var $con;
		var $idnumventa;
		var $idusuario;
		var $fecha;
		public function __construct()
		{
			$this->con = new Conexion();
			if($this->con->conectar())
			{
			}else
			{
				echo "error";
			}
		
		}
		
		public function getIdNumVenta()
		{
			return $this->idnumventa;
		}
		
		public function getIdUsuario()
		{
			return $this->idusuario;
		}
		public function getFecha()
		{
			return $this->fecha();
		}
		
		public function setIdNumVenta($idnumventa)
		{
			$this->idnumventa = $idnumventa;
		}
		public function setIdUsuario($idusuario)
		{
			$this->idusuario = $idusuario;
		}
		public function setFecha($fecha)
		{
			$this->fecha = $fecha;
		}
		
		
		public function createNumVenta()
		{
			$sentencia = "insert into numventa(idusuario,fecha)values("
				.$this->idusuario.","
				."'".$this->fecha."')";
				
			if($this->con->insert($sentencia))
			{
				$sentencia = "select idnumventa from numventa where idusuario=".$this->idusuario." and fecha='".$this->fecha."'";;
				//echo $sentencia;
				$reg = mysql_query($sentencia,$this->con->con);
				
				if($reg)
				{
					while($res = mysql_fetch_assoc($reg))
					{
						$this->idnumventa = $res['idnumventa'];
					}
					
					return $this->idnumventa;
				}
			}
			return 0;
		}
		
		
		public function createNota()
		{
			$sentencia = "insert into notas(idnumventa)values("
				.$this->idnumventa.")";
			
			return($this->con->insert($sentencia));
		}
		
		public function createFactura()
		{
			$sentencia = "insert into facturas(idnumventa)values("
				.$this->idnumventa.")";
			
			return($this->con->insert($sentencia));
		}
	}
	
	class Venta extends Noventa
	{
		protected $idventa,$cantidad,$precio;
		protected $producto;
		
		public function getIdventa()
		{
			return $this->idventa;
		}
		
		public function getProducto()
		{
			return $this->producto;
		}
		public function getCantidad()
		{
			return $this->cantidad;
		}
		public function getPrecio()
		{
			return $this->precio;
		}
		
		public function setIdVenta($idventa)
		{
			$this->idventa = $idventa;
		}
		
		public function setProducto($producto)
		{
			$this->producto = $producto;
		}
		
		public function setCantidad($cantidad)
		{
			$this->cantidad = $cantidad;
		}
		
		public function setPrecio($precio)
		{
			$this->precio = $precio;
		}
		
		public function createVenta()
		{
			$sentencia = "insert into ventas(idnumventa,producto,cantidad,precio)values("
				.$this->idnumventa.","
				."'".$this->producto."',"
				.$this->cantidad.","
				.$this->precio.")";
				
			//echo $sentencia;
			return($this->con->insert($sentencia));
		}
	}
?>