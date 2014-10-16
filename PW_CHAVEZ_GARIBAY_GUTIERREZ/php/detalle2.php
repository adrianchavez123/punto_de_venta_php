<?php

	require_once('GenerarNota.php');
	require_once("Session.php");
	require_once("Producto.php");
	
	
	$session = new Session();
	$session->verificar();
	 
	if(isset($_GET['idnumventa']) && !empty($_GET['idnumventa']))
	{
		$prod = new Producto();
		
		$generar = new GenerarPdf("P","mm","Letter");
		$generar->AddPage();
		
		$generar->writeFolio($prod->getNota($_GET['idnumventa']));
		$generar->writeProductos($_GET['idnumventa']);
		$generar->writeDatosEmpresa();	
								
		$generar->Output();
	}
?>