<?php

	require_once("Conexion.php");
	
	class DatosOrganizacion
	{
		var $RFC,$razonSocial;
		var $con;
		
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
		public function getRFC()
		{
			return $this->RFC;
		}
		
		public function getRazonSocial()
		{
			return $this->razonSocial;
		}
		
		public function setRFC($RFC)
		{
			$this->RFC = $RFC;
		}
		
		public function setRazonSocial($razonSocial)
		{
			$this->razonSocial = $razonSocial;
		}
		
		public function insertDatosOrganizacion($id)
		{
			if(!empty($this->RFC) && !empty($this->razonSocial))
			{
				$sentencia = "insert into datosorganizacion(RFC,razonSocial,idUsuario)values("
					."'".$this->RFC."',"
					."'".$this->razonSocial."',"
					.$id.")";
				//echo $sentencia;
				
				return ($this->con->insert($sentencia));
			}
			else
			{
				return false;
			}
		}
		
		public function getDatosOrganizacionByIdDb($id)
		{
				$sentencia = "select * from datosorganizacion where idUsuario=".$id;
				$reg = mysql_query($sentencia,$this->con->con);
				if($reg)
				{
					$num = mysql_num_rows($reg);
					if($num == 1)
					{
						while($res = mysql_fetch_assoc($reg))
						{
							$this->RFC = $res['RFC'];
							$this->razonSocial = $res['razonSocial'];
						}
						
						return true;
					}
				}
				else
				{
					return false;
				}
				
		}
		
		public function updateRFC($nuevo,$id)
		{
			$sentencia = "select * from datosorganizacion where idUsuario=".$id;
			$reg = mysql_query($sentencia,$this->con->con);
			if($reg)
			{
				$num = mysql_num_rows($reg);
				if($num == 0)
				{
					$sentencia = "insert into datosorganizacion(idUsuario,RFC)values(".$id.",'".$nuevo."')";
				}
				else
				{
					$sentencia = "update datosorganizacion set RFC = '".$nuevo."' where idUsuario=".$id;
				}
				return ($this->con->insert($sentencia));
			}
			return false;
			
		}
		public function updateRazonSocial($nuevo,$id)
		{
			$sentencia = "select * from datosorganizacion where idUsuario=".$id;
			$reg = mysql_query($sentencia,$this->con->con);
			if($reg)
			{
				$num = mysql_num_rows($reg);
				if($num == 0)
				{
					$sentencia = "insert into datosorganizacion(idUsuario,razonSocial)values(".$id.",'".$nuevo."')";
				}
				else
				{
					$sentencia = "update datosorganizacion set razonSocial = '".$nuevo."' where idUsuario=".$id;
				}
				return ($this->con->insert($sentencia));
			}
			return false;
		}
	}
	
	class DatosPersonales extends DatosOrganizacion
	{
		protected  $nombre,$Apaterno,$Amaterno,$fechaNacimiento,$username,$password;
		protected  $preguntaSecreta,$RespuestaPregunta,$cuidad,$estado,$cp,$colonia;
		protected  $calle,$noInterior,$noExterior,$telefono,$email;
		protected $id;
		
		public function getDatosIdByNombreApellidos($nombre,$apaterno,$amaterno)
		{
			$sentencia = "select idUsuario from usuarios where nombre ='".$nombre."' and Apaterno = '".$apaterno."' and Amaterno = '".$amaterno."'";
			$res = mysql_query($sentencia,$this->con->con);
			$id;
			if($res)
			{
				$num = mysql_num_rows($res);
				if($num == 1)
				{
					while($x = mysql_fetch_assoc($res))
					{
						$id = $x['idUsuario'];
					}
					return $id;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		public function getId()
		{
			return $this->id;
		}
		
		public function getNombre()
		{
			return $this->nombre;
		}
		
		public function getApaterno()
		{
			return $this->Apaterno;
		}
		
		public function getAmaterno()
		{
			return $this->Amaterno;
		}
		
		public function getFechaNacimiento()
		{
			return $this->fechaNacimiento;
		}
		
		public function getUsername()
		{
			return $this->username;
		}
		
		public function getPassword()
		{
			return $this->password;
		}
		
		public function getPreguntaSecreta()
		{
			return $this->preguntaSecreta;
		}
		
		public function getRespuestaPregunta()
		{
			return $this->RespuestaPregunta;
		}
		
		public function getCuidad()
		{
			return $this->cuidad;
		}
		
		public function getEstado()
		{
			return $this->estado;
		}
		
		public function getCp()
		{
			return $this->cp;
		}
		public function getColonia()
		{
			return $this->colonia;
		}
		
		public function getCalle()
		{
			return $this->calle;
		}
		public function getNoInterior()
		{
			return $this->noInterior;
		}
		public function getNoExterior()
		{
			return $this->noExterior;
		}
		public function getTelefono()
		{
			return $this->telefono;
		}
		public function getEmail()
		{
			return $this->email;
		}
		
		public function setId($id)
		{
			$this->id = $id;
		}
		
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}
		public function setApaterno($Apaterno)
		{
			$this->Apaterno = $Apaterno;
		}
		public function setAmaterno($Amaterno)
		{
			$this->Amaterno = $Amaterno;
		}
		public function setFechaNacimiento($fechaNacimiento)
		{
			$this->fechaNacimiento = $fechaNacimiento;
		}
		public function setUsername($username)
		{
			$this->username = $username;
		}
		public function setPassword($password)
		{
			$this->password = $password;
		}
		public function setPreguntaSecreta($preguntaSecreta)
		{
			$this->preguntaSecreta = $preguntaSecreta;
		}
		public function setRespuestaPregunta($RespuestaPregunta)
		{
			$this->RespuestaPregunta = $RespuestaPregunta;
		}
		public function setCuidad($cuidad)
		{
			$this->cuidad = $cuidad;
		}
		public function setEstado($estado)
		{
			$this->estado = $estado;
		}
		public function setCp($cp)
		{
			$this->cp = $cp;
		}
		public function setColonia($colonia)
		{
			$this->colonia = $colonia;
		}
		public function setCalle($calle)
		{
			$this->calle = $calle;
		}
		public function setNoInterior($noInterior)
		{
			$this->noInterior = $noInterior;
		}
		public function setNoExterior($noExterior)
		{
			$this->noExterior = $noExterior;
		}
		public function setTelefono($telefono)
		{
			$this->telefono = $telefono;
		}
		public function setEmail($email)
		{
			$this->email = $email;
		}
		
		public function insertDatosPersonales()
		{
			$sentencia = "insert into usuarios(nombre,Apaterno,Amaterno,username,password,"
			."preguntaSecreta,RespuestaPregunta,cuidad,estado,cp,colonia,calle,noExterior,"
			."email)values("
			."'".$this->nombre."',"
			."'".$this->Apaterno."',"
			."'".$this->Amaterno."',"
			."'".$this->username."',"
			."'".md5($this->password)."',"
			."'".$this->preguntaSecreta."',"
			."'".$this->RespuestaPregunta."',"
			."'".$this->cuidad."',"
			."'".$this->estado."',"
			.$this->cp.","
			."'".$this->colonia."',"
			."'".$this->calle."',"
			."'".$this->noExterior."',"
			."'".$this->email."')";
			
			if($this->con->insert($sentencia))
			{
				//echo $sentencia;
			
				if(!empty($this->noInterior))
				{
					$sentencia = "update usuarios set noInterior='".$this->noInterior."' where username='".$this->username."' and password='"
						.md5($this->password)."'";
					$this->con->insert($sentencia);
					//echo $sentencia;
			
				}
				
				if(!empty($this->telefono))
				{
					$sentencia = "update usuarios set telefono=".$this->telefono." where username='".$this->username."' and password='"
						.md5($this->password)."'";
					$this->con->insert($sentencia);
					//echo $sentencia;
			
				}
				
				if(!empty($this->fechaNacimiento))
				{
					$sentencia = "update usuarios set fechaNacimiento='".$this->fechaNacimiento."' where username='".$this->username."' and password='"
						.md5($this->password)."'";
					$this->con->insert($sentencia);
					//echo $sentencia;
			
				}
				
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function getDatosPersonalesByIdDb($id)
		{
				$sentencia = "select * from usuarios where idUsuario=".$id;
				$reg = mysql_query($sentencia,$this->con->con);
				if($reg)
				{
					$num = mysql_num_rows($reg);
					if($num == 1)
					{
						while($res = mysql_fetch_assoc($reg))
						{
							//var_dump($res);
							$this->id = $res['idUsuario'];
							$this->nombre = $res['nombre'];
							$this->Apaterno = $res['Apaterno'];
							$this->Amaterno = $res['Amaterno'];
							$this->fechaNacimiento = $res['fechaNacimiento'];
							$this->username = $res['username'];
							$this->password = $res['password'];
							$this->preguntaSecreta = $res['preguntaSecreta'];
							$this->RespuestaPregunta = $res['RespuestaPregunta'];
							$this->cuidad = $res['cuidad'];
							$this->estado = $res['estado'];
							$this->cp = $res['cp'];
							$this->colonia = $res['colonia'];
							$this->calle = $res['calle'];
							$this->noInterior = $res['noInterior'];
							$this->noExterior = $res['noExterior'];
							$this->telefono = $res['telefono'];
							$this->email = $res['email'];
						}
						

						return true;
					}
				}
				else
				{
					return false;
				}
				
		}
		
		
		public function updatePassword($nuevo)
		{
			$sentencia = "update usuarios set password = '".md5($nuevo)."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		
		public function updateFechaNacimiento($nuevo)
		{
			$sentencia = "update usuarios set fechaNacimiento = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateCuidad($nuevo)
		{
			$sentencia = "update usuarios set cuidad = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateEstado($nuevo)
		{
			$sentencia = "update usuarios set estado = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateCp($nuevo)
		{
			$sentencia = "update usuarios set cp = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateColonia($nuevo)
		{
			$sentencia = "update usuarios set colonia = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateCalle($nuevo)
		{
			$sentencia = "update usuarios set calle = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateNoExterior($nuevo)
		{
			$sentencia = "update usuarios set noExterior = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateNoInterior($nuevo)
		{
			$sentencia = "update usuarios set noInterior = '".$nuevo."' where idUsuario=".$this->id;
			return ($this->con->insert($sentencia));
		}
		public function updateTelefono($nuevo)
		{
			$sentencia = "update usuarios set telefono = ".$nuevo." where idUsuario=".$this->id;
			echo $sentencia;
			return ($this->con->insert($sentencia));
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
?>