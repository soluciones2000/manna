<?php 
include_once("conexion.php");
include_once('Pdf.php');

$tit_codigo = isset($_POST['tit_codigo']) ? strtoupper($_POST['tit_codigo']) : null;
$correo = isset($_POST['email']) ? $_POST['email'] : 0;

if (isset($_POST['tit_codigo'])){
	$quer0 = "SELECT * FROM empresa";
	$resul0 = mysql_query($quer0,$link);
	$ro0 = mysql_fetch_array($resul0);
	$emp_nombre = $ro0["emp_nombre"];
	$emp_email = $ro0["emp_email"];

	$query = "SELECT * FROM afiliados WHERE tit_codigo='".$tit_codigo."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$tipo_persona = $row["tipo_persona"];
		$tit_nombres = utf8_encode($row["tit_nombres"]);
		$tit_apellidos = utf8_encode($row["tit_apellidos"]);
		$tipo_afiliado = $row["tipo_afiliado"];
		$tit_cedula = $row["tit_cedula"];
		$tit_codigo_largo = $row["tit_codigo_largo"];
		$enrol_nombre_completo = utf8_encode($row["enrol_nombre_completo"]);
		$enrol_codigo = $row["enrol_codigo"];
		$patroc_nombre_completo = utf8_encode($row["patroc_nombre_completo"]);
		$patroc_codigo = $row["patroc_codigo"];
		$email = $row["email"];

		$pdf = new PDF('P', 'mm', 'letter', true, 'UTF‐8', false);
		$pdf->SetTitle('CERTIFICADO DE AFILIACIÓN');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_MAIN));
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(true,PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setPrintHeader(false);
		$pdf->AddPage();
		// get the current page break margin
		$bMargin = $pdf->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $pdf->getAutoPageBreak();
		// disable auto-page-break
		$pdf->SetAutoPageBreak(false, 0);
		// set bacground image
		$img_file = K_PATH_IMAGES.'fondocertificado.jpg';
		$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$pdf->setPageMark();		
		if ($tipo_persona<>"Especialista") {
			$texto = '
				<br>
				<br>
				<br>
				<br>
				<h1 align="center">CERTIFICADO DE AFILIACIÓN</h1>
				<br>
				<br>
				<h3 align="center">BIENVENIDO</h3>
				<br>
				<br>
				<p align="right"><b> Número de afiliado: </b>'.trim($tit_codigo).'</p>
				<br>
				<h4 align="center">DATOS DEL AFILIADO</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($tit_nombres).' '.trim($tit_apellidos).'<br>
					<b>Tipo de afiliado: </b>'.trim($tipo_afiliado).'<br>
					<b>Cédula de identidad: </b>'.trim($tit_cedula).'<br>
					<b>Código del sistema: </b>'.trim($tit_codigo_largo).'<br>
				</p>
				<br>
				<br>
				<br>
				<br>
				<h4 align="center">DATOS DEL ENROLADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($enrol_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($enrol_codigo).'<br>
				</p>
				<br>
				<br>
				<br>
				<br>
				<br>
				<h4 align="center">DATOS DEL PATROCINADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($patroc_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($patroc_codigo).'<br>
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
			';
			$mensaje = '
				<br>
				<h3 align="center">BIENVENIDO</h3>
				<br>
				<br>
				<p align="right"><b> Número de afiliado: </b>'.trim($tit_codigo).'</p>
				<br>
				<h4 align="center">DATOS DEL AFILIADO</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($tit_nombres).' '.trim($tit_apellidos).'<br>
					<b>Tipo de afiliado: </b>'.trim($tipo_afiliado).'<br>
					<b>Cédula de identidad: </b>'.trim($tit_cedula).'<br>
					<b>Código del sistema: </b>'.trim($tit_codigo_largo).'<br>
				</p>
				<br>
				<br>
				<h4 align="center">DATOS DEL ENROLADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($enrol_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($enrol_codigo).'<br>
				</p>
				<br>
				<br>
				<br>
				<h4 align="center">DATOS DEL PATROCINADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($patroc_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($patroc_codigo).'<br>
				</p>
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
				<p align="justify">
					<b>NOTA IMPORTANTE: </b>Este certificado no es un recibo de ingreso, la emisión de este documento significa que el afiliado ha completado exitosamente el proceso de registro y que forma parte de nuestra base de datos, para completar el proceso deberá realizar los trámites administrativos correspondientes.
					<br>
				</p>
			';
		} else {
			$texto = '
				<br>
				<br>
				<br>
				<br>
				<h1 align="center">CERTIFICADO DE AFILIACIÓN</h1>
				<br>
				<br>
				<h3 align="center">BIENVENIDO</h3>
				<br>
				<br>
				<p align="right"><b> Número de afiliado: </b>'.trim($tit_codigo).'</p>
				<br>
				<h4 align="center">DATOS DEL AFILIADO</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($tit_nombres).' '.trim($tit_apellidos).'<br>
					<b>Tipo de afiliado: </b>'.trim($tipo_afiliado).'<br>
					<b>Cédula de identidad: </b>'.trim($tit_cedula).'<br>
					<b>Código del sistema: </b>'.trim($tit_codigo_largo).'<br>
				</p>
				<br>
				<br>
				<br>
				<br>
				<h4 align="center">DATOS DEL ENROLADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($enrol_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($enrol_codigo).'<br>
				</p>
				<br>
				<br>
				<br>
				<br>
				<br>
				<h4 align="center">DATOS DEL PATROCINADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($patroc_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($patroc_codigo).'<br>
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
			';
			$mensaje = '
				<br>
				<h3 align="center">BIENVENIDO</h3>
				<br>
				<br>
				<p align="right"><b> Número de afiliado: </b>'.trim($tit_codigo).'</p>
				<br>
				<h4 align="center">DATOS DEL AFILIADO</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($tit_nombres).' '.trim($tit_apellidos).'<br>
					<b>Tipo de afiliado: </b>'.trim($tipo_afiliado).'<br>
					<b>Cédula de identidad: </b>'.trim($tit_cedula).'<br>
					<b>Código del sistema: </b>'.trim($tit_codigo_largo).'<br>
				</p>
				<br>
				<br>
				<h4 align="center">DATOS DEL ENROLADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($enrol_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($enrol_codigo).'<br>
				</p>
				<br>
				<br>
				<br>
				<h4 align="center">DATOS DEL PATROCINADOR</h4>
				<br>
				<p align="left">
					<b>Nombre: </b>'.trim($patroc_nombre_completo).'<br>
					<b>Número de afiliado: </b>'.trim($patroc_codigo).'<br>
				</p>
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
				<p align="justify">
					<b>NOTA IMPORTANTE: </b>Este certificado no es un recibo de ingreso, la emisión de este documento significa que el afiliado ha completado exitosamente el proceso de registro y que forma parte de nuestra base de datos, para completar el proceso deberá realizar los trámites administrativos correspondientes.
					<br>
				</p>
				<br>
				<br>
				<p align="justify">
					<b>DOCUMENTOS: </b>Por favor escanee y envíe sus credenciales profesionales que lo avalen como Médico o profesional de la salud al email <a href="documentos@corporacionmanna.com" target="_blank">documentos@corporacionmanna.com</a>.
					<br>
				</p>
			';
		}
		$pdf->Writehtml($texto, true, false, true, false, '');
		if ($correo) {
//			$pdf->Output('Certificado_'.trim($tit_codigo_largo).'.pdf', 'I');

			$archivo = 'Certificado_'.trim($tit_codigo_largo).'.pdf';

			$asunto = 'CORPORACIÓN MANNA - Certificado de Afiliado: '.trim($tit_codigo_largo);

			$uid = "_".md5(uniqid(time())); 

			$cabeceras .= "MIME-version: 1.0\r\n";
			$cabeceras .= "Content-type: multipart/mixed;";
			$cabeceras .= "boundary=".$uid."\r\n";

			// Pimera parte del mensaje: cuerpo del mensaje
			$cabeceratexto = "--".$uid."\r\n";
			$cabeceratexto .= "Content-type: text/html;charset=utf-8\r\n";
			$cabeceratexto .= "Content-Transfer-Encoding: 8bit\r\n";
			$cabeceratexto .= "\r\n";

			$mensaje = $cabeceratexto.$mensaje;
			$mensaje .= "\r\n";

			// Segunda parte del mensaje, archivo adjunto
			$mensaje .= "--".$uid."\r\n";

			// Codificar el archivo
			$mensaje .= $pdf->Output('Certificado_'.trim($tit_codigo_largo).'.pdf', 'E');

			$mensaje .= "\r\n";
			$mensaje .= "\r\n";
			$mensaje .= "--".$uid."--\r\n";

			mail($email,$asunto,$mensaje,$cabeceras);
		}
		$pdf->Output('Certificado_'.trim($tit_codigo_largo).'.pdf', 'I');
	}
}

?>
