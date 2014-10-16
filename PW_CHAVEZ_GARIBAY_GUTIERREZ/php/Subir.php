<?php

	class Subir
	{
		public function upload($nombre)
		{
			$ruta = "images/".$nombre.".jpg";
			$ruta = str_replace(" ","_",$ruta,$count);
			
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			if (in_array($_FILES['imagen']['type'], $permitidos) ){
			
				if ($_FILES['imagen']['size'] <= 2000000) {
				
					copy($_FILES['imagen']['tmp_name'], $ruta);
					
				}
			}
			else
			{
				echo "solo imagenes";
				$ruta = "images/sin_imagen.png";
			}
			
			return $ruta;
		}
	}

?>