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
			
		}
		
		function writeFolio($folio)
		{
			$this->folio = $folio;
			$this->SetXY(100,40);
			$this->Cell(70,10,'FECHA',1,0,'C');
			$this->SetXY(100,50);
			$this->Cell(23,10,date("d"),1,0,'C');
			$this->SetXY(123,50);
			$this->Cell(23,10,date("m"),1,0,'C');
			$this->SetXY(146,50);
			$this->Cell(24,10, date("y"),1,0,'C');
			
			$this->SetXY(30,40);
			$this->SetFont('Arial','',25);
			$this->Cell(50,30, utf8_decode("NOTA DE REMISION"),0,0,'C');
			
			
			$this->SetXY(100,60);
			$this->SetFont('Arial','',12);
			$this->Cell(70,12,"No",1,0,'L');
			$this->folio = $folio;
			$this->SetXY(130,60);
			$this->Cell(40,12,$folio,0,0,'C');
			
		}
		
		
		
		function writeProductos($id)
		{
			$this->SetXY(15,80);
			$this->SetFont('Arial','',15);
			$this->Cell(30,10,'CANTIDAD',1,0,'C');
			$this->SetXY(45,80);
			$this->Cell(60,10,utf8_decode('DESCRIPCIÓN'),1,0,'C');
			$this->SetXY(105,80);
			$this->Cell(40,10,'P UNITARIO',1,0,'C');
			$this->SetXY(145,80);
			$this->Cell(25,10,'IMPORTE',1,0,'C');
			
			$y = 90;
			
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
			
			$this->SetXY(105,$y);
			$this->Cell(40,10,"Total",1,0,'C');
			$this->SetXY(145,$y);
			$this->Cell(25,10,$total,1,0,'C');
					
			
			
			
		}
	}
?>