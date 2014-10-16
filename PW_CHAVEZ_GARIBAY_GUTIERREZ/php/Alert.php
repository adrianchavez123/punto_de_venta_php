<?php

	class Alert
	{
		public function imprimir($mensaje,$tipo)
		{
			if($tipo == 1)
			{
				echo "<h1 class='error'>$mensaje</h1>";

			}
			else if($tipo == 2)
			{
				echo "<h1 class='warning'>$mensaje</h1>";
			}
			else if($tipo == 3)
			{
				echo "<h1 class='success'>$mensaje</h1>";
			}
		}
	}
?>