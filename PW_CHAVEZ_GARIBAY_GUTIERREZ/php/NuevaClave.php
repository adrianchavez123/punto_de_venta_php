<?php

	class NuevaClave
	{

		var $limite = 8;
		var $alfabeto = 'abcdefghijklmnopqrstuvwxyz1234567890';

		public function generar()
		{
			if($this->limite>0)
			{
		        $clave = "";
		        $this->alfabeto = str_split($this->alfabeto,1);
		        for($i=1; $i<=$this->limite; $i++){
		           
		            mt_srand((double)microtime() * 1000000);

		            $num = mt_rand(1,count($this->alfabeto));
		            
		            $clave .= $this->alfabeto[$num-1];
		        }
 
    		}

   	 		return $clave;
		}
	}
?>