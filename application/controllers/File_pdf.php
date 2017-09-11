<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_pdf extends CI_Controller {
//*** Constructor ***
	public function __construct(){
		parent::__construct();
	}
/*
//*** Para generar el pdf ***
	public function reg_pdf(){
		$this->load->library('PDF');
		$pdf = new PDF('P', 'mm', 'letter', true, 'UTF‐8', false);

//		$pdf->SetAuthor('Corporación Manna Venezuela C.A.');
		$pdf->SetTitle('CERTIFICADO DE AFILIACIÓN');

		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// set header and footer fonts
//		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_MAIN));


		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(true,PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage();
		$pdf->Writehtml('
			<br>
			<h3 align="center">BIENVENIDO</h3>
			<br>
			<br>
			<p align="right"><b> Número de afiliado: </b><?php echo $id ?></p>
			<br>
			<h4 align="center">DATOS DEL AFILIADO</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>Luis Rodríguez<br>
				<b>Cédula de identidad: </b>Luis Rodríguez<br>
				<br>
				<b>Cotitular: </b>Luis Rodríguez<br>
				<b>Cédula de identidad: </b>Luis Rodríguez<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<h4 align="center">DATOS DEL ENROLADOR</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>Luis Rodríguez<br>
				<b>Número de afiliado: </b>Luis Rodríguez<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<h4 align="center">DATOS DEL PATROCINADOR</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>Luis Rodríguez<br>
				<b>Número de afiliado: </b>Luis Rodríguez<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<p align="center">
				-----------------------------------------------------------
				<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<p align="justify">
				<b>NOTA IMPORTANTE: </b>Este certificado no es un recibo de ingreso, la emisión de este documento significa que el afiliado ha completado exitosamente el proceso de registro y que forma parte de nuestra base de datos, para completar el proceso deberá realizar los trámites administrativos correspondientes.
				<br>
			</p>
		');
		$pdf->Output('My‐File‐Name.pdf', 'I');
	}
*/
}
