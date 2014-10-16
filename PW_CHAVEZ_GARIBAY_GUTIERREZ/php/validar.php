<?php




require_once("Conexion.php");
	
	class Validar
	{
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
		
		public function val()
		{
			$sen = "select * from  datosOrganizacion where idUsuario=".$_SESSION['id'];
			$x = mysql_query($sen,$this->con->con);
			
			$row = mysql_num_rows($x);
			
			if($row != 1)
			{
				//echo "<script>alert('debes completar tus datos');</script>";
				//header('location:../miCuenta.php');
				//exit;
				return "false";
			}
			else
			{
				//echo "<script>alert('datos completos');</script>";
				return "true";
			}
		}
		
	}
	
	
	//$val = new Validar();
	//$val->val();
?>










