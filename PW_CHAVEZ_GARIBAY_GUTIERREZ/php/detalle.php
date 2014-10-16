<?php

	require_once('GenerarPdf.php');
	require_once("Session.php");
	require_once("Producto.php");
	
	
	$session = new Session();
	$session->verificar();
	 
	if(isset($_GET['idnumventa']) && !empty($_GET['idnumventa']))
	{
		$prod = new Producto();
		
		$generar = new GenerarPdf("P","mm","Letter");
		$generar->AddPage();
		
		$generar->writeDatosEmpresa();	
		$generar->writeFolio($prod->getFactura($_GET['idnumventa']));
		$generar->writeDatosCliente($_SESSION['id']);
		$generar->writeProductos($_GET['idnumventa']);
								
		$generar->Output();
	}
?>