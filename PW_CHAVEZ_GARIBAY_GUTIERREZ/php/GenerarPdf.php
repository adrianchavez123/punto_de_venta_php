<?php

	require_once('PDF/fpdf.php');
	require_once("Datos.php");
	require_once("Producto.php");
	
	class GenerarPdf extends FPDF
	{
		protected $datos = array('Nombre de la empresa','Direccion',
					'telefono','ciudad','RFC');
		protected $cp = "cp";
		protected $form = array();
		protected $folio;
		protected $productos = array(
			array('cantidad' =>'2','descripcion' =>'camara','pUnitario' =>215.2,'importe' =>4310.3),
			array('cantidad' =>'1','descripcion' =>'microfono','pUnitario' =>862.1,'importe' =>862.1),
			array('cantidad' =>'2','descripcion' =>'camara','pUnitario' =>215.2,'importe' =>4310.3),
			array('cantidad' =>'2','descripcion' =>'camara','pUnitario' =>215.2,'importe' =>4310.3),
			array('cantidad' =>'2','descripcion' =>'camara','pUnitario' =>215.2,'importe' =>4310.3)
			
		);
		function Header()
		{
		   

			$this->SetFont('Arial','B',15);

			$this->SetXY(5,5);
			$this->SetDrawColor(0,80,180);
			$this->SetFillColor(230,230,0);
			$this->Image('header.png',0,5);
			$this->SetLineWidth(2);
			$this->Cell(205,30,"materiales",1,1,'R');

		 
		  
		}
		
		function Footer()
		{
		  
			$this->SetY(-15);

			$this->SetFont('Arial','BI',12);
			$this->Cell(0,10,'materiales.com',0,0,'C');
			$this->SetFont('','',8);
			$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
		}
		
		function writeDatosEmpresa()
		{
			foreach($this->datos as $dato)
			{
				$this->Ln(10);
				$this->SetFont('Arial','B',15);
				$this->Cell(100,12,$dato,0,0,'L');
			}
			
			$this->SetXY(90,60);
			$this->Cell(100,12,$this->cp,0,0,'L');
		}
		
		function writeFolio($folio)
		{
			$this->folio = $folio;
			$this->SetXY(130,50);
			$this->SetFont('Arial','',12);
			$this->Cell(40,12,"FACTURA",1,0,'C');
			$this->SetXY(130,62);
			$this->Cell(40,12,$folio,1,0,'C');
			$this->SetXY(100,80);
			$this->Cell(70,10,'FECHA',1,0,'C');
			$this->SetXY(100,90);
			$this->Cell(23,10,date('d'),1,0,'C');
			$this->SetXY(123,90);
			$this->Cell(23,10,date('m'),1,0,'C');
			$this->SetXY(146,90);
			$this->Cell(24,10, date('y'),1,0,'C');
		}
		
		public function writeDatosCliente($idCliente)
		{
			$datos = new DatosPersonales();
			$datos->getDatosPersonalesByIdDb($idCliente);
			$datos->getDatosOrganizacionByIdDb($idCliente);
	
			$this->Line(15,115,170, 115);
			$this->SetXY(20,120);
			$this->Cell(70,10,utf8_decode('Nombre '.$datos->getNombre()." ".$datos->getApaterno().' '.$datos->getAmaterno()),0,0,'L');
			$this->Line(15,130,170, 130);
			$this->SetXY(20,135);
			$this->Cell(70,10,utf8_decode('domicilio '.$datos->getCalle().' '.$datos->getNoExterior()."   ".$datos->getCp()),0,0,'L');
			$this->Line(15,145,170, 145);
			$this->SetXY(20,150);
			$this->Cell(70,10,utf8_decode('colonia '.$datos->getColonia().' poblacion '.$datos->getCuidad()." RFC cliente ".$datos->getRFC()),0,0,'L');
			$this->Line(15,160,170, 160);
		}
		
		function writeProductos($id)
		{
			$this->SetXY(15,170);
			$this->SetFont('Arial','',15);
			$this->Cell(30,10,'CANTIDAD',1,0,'C');
			$this->SetXY(45,170);
			$this->Cell(60,10,utf8_decode('DESCRIPCIÓN'),1,0,'C');
			$this->SetXY(105,170);
			$this->Cell(40,10,'P UNITARIO',1,0,'C');
			$this->SetXY(145,170);
			$this->Cell(25,10,'IMPORTE',1,0,'C');
			
			$y = 180;
			
			$prod = new Producto();
			$this->productos = $prod->getProductosNota($id);
			$i = 0;
			$total = 0;
			foreach($this->productos['producto'] as $value)
			{
				$this->SetXY(15,$y);
				$this->SetFont('Arial','B',15);
				$this->Cell(30,10,$this->productos['cantidad'][$i],1,0,'C');
				$this->SetXY(45,$y);
				$this->Cell(60,10,utf8_decode($value),1,0,'C');
				$this->SetXY(105,$y);
				$this->Cell(40,10,$this->productos['precio'][$i],1,0,'C');
				$this->SetXY(145,$y);
				$importe = ($this->productos['precio'][$i]*$this->productos['cantidad'][$i]);
				
				$this->Cell(25,10,$importe,1,0,'C');
				$y+=10;
				
				$total += $importe;
				$i++;
				
				if($y> 200)
				{
					$this->AddPage();
					$y = 50;
				}
			}
			
			$iva = ($total*0.16);
			$total2 = $total + $iva;
			$y+=10;
			$this->Line(45,$y,170,$y );
			
			$this->Rect(110, $y+10, 60, 30, '');
			$this->SetXY(115,$y+10);
			$this->Cell(15,10,utf8_decode('Subtotal '),0,0,'C');
			$this->SetXY(115,$y+20);
			$this->Cell(15,10,utf8_decode(' IVA'),0,0,'C');
			$this->SetXY(115,$y+30);
			$this->Cell(15,10,utf8_decode(' Total'),0,0,'C');
			$this->Line(135,$y+20,160, $y+20);
			$this->Line(135,$y+30,160, $y+30);
			$this->Line(135,$y+38,160, $y+38);
			$this->SetXY(135,$y+10);
			$this->Cell(15,10,$total,0,0,'C');
			$this->SetXY(135,$y+20);
			$this->Cell(15,10,$iva,0,0,'C');
			$this->SetXY(135,$y+30);
			$this->Cell(15,10,$total2,0,0,'C');
			
		}
	}
?>









