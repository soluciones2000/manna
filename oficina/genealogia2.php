<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';

/*
// Rellenar la tabla para el reporte
$quer0 = "DELETE FROM repbonoafiliacion WHERE 1";
$resul0 = mysql_query($quer0,$link);

$query = "SELECT * FROM patrocinio order by patroc_codigo,tit_codigo";
$result = mysql_query($query,$link);
$txt = "";
while($row = mysql_fetch_array($result)) {
   	$patroc_codigo = $row["patroc_codigo"];
    $tit_codigo = $row["tit_codigo"];
    $fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
    $fecha_fin_bono =  $row["fecha_fin_bono"];

	$quer2 = "SELECT * from organizacion where organizacion.organizacion='".$tit_codigo."' and nivel>='0' AND nivel<'3' order by nivel,afiliado";
	$resul2 = mysql_query($quer2,$link);
	$m = 0;
	$d2 = false;
	$ha1 = true;
	$st = 0.00;
	while($ro2 = mysql_fetch_array($resul2)) {
		$nivel = $ro2["nivel"]+1;
		$afiliado = $ro2["afiliado"];

		$quer3 = "SELECT * from afiliados where tit_codigo='".$afiliado."'";
		$resul3 = mysql_query($quer3,$link);
		if($ro3 = mysql_fetch_array($resul3)) {
			$tipo_afiliado = $ro3["tipo_afiliado"];

			$quer4 = " SELECT * from transacciones where afiliado='".$afiliado."' and tipo='01' and fecha>='".$fecha_afiliacion."' and fecha<='".$fecha_fin_bono."' and status_comision='Pendiente'";
			$resul4 = mysql_query($quer4,$link);
			if($ro4 = mysql_fetch_array($resul4)) {
				$monto = $ro4["monto"];
				$fectr = $ro4["fecha"];

				$quer5 = "SELECT * from bono_afiliacion where bono_afiliacion.nivel='".trim($nivel)."'";
				$resul5 = mysql_query($quer5,$link);
				$ro5 = mysql_fetch_array($resul5);
				$porcentaje = 0.00;
				switch ($tipo_afiliado) {
					case 'Premium':
						$porcentaje = $ro5["premium"];
						break;
					case 'VIP':
						$porcentaje = $ro5["vip"];
						break;
					case 'Oro':
						$porcentaje = $ro5["oro"];
						break;
				}
				$comision = $monto*($porcentaje/100);
				if ($monto<>0.00) {
					$quer6 = "INSERT INTO repbonoafiliacion VALUES ('".$patroc_codigo."','".$tit_codigo."','".$fecha_afiliacion."','".$fecha_fin_bono."',".$nivel.",'".$afiliado."','".$tipo_afiliado."','".$fectr."',".$monto.",".$porcentaje.",".$comision.");";
					$resul6 = mysql_query($quer6,$link);
				}
			}
		}
	}
}
// Hasta aqui rellena la tabla para el reporte
*/

// +-----------------------------------------------------------------------+
// | Copyright (c) 2002-2005, Richard Heyes, Harald Radi                   |
// | All rights reserved.                                                  |
// |                                                                       |
// | Redistribution and use in source and binary forms, with or without    |
// | modification, are permitted provided that the following conditions    |
// | are met:                                                              |
// |                                                                       |
// | o Redistributions of source code must retain the above copyright      |
// |   notice, this list of conditions and the following disclaimer.       |
// | o Redistributions in binary form must reproduce the above copyright   |
// |   notice, this list of conditions and the following disclaimer in the |
// |   documentation and/or other materials provided with the distribution.| 
// | o The names of the authors may not be used to endorse or promote      |
// |   products derived from this software without specific prior written  |
// |   permission.                                                         |
// |                                                                       |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
// |                                                                       |
// +-----------------------------------------------------------------------+
// | Author: Richard Heyes <http://www.phpguru.org/>                       |
// |         Harald Radi <harald.radi@nme.at>                              |
// +-----------------------------------------------------------------------+
//
// $Id: example.php 181173 2005-03-02 02:16:51Z richard $
//error_reporting(E_ALL | E_STRICT);
    require_once('html_tree_menu/TreeMenu.php');

    $icon         = 'folder.gif';
    $expandedIcon = 'folder-expanded.gif';

    $menu  = new HTML_TreeMenu();
	$query = "SELECT * FROM v_genealogia where padre>='".$codigo."' order by padre,hijo";
	if ($result = mysql_query($query,$link)) {
		$padre = '';
		$hijo = '';
		$first = true;
		$second = true;
		$nodos = array();
		while($row = mysql_fetch_array($result)) {
			if ($first) {
				$padre = $row["padre"];
				$hijo = $row["hijo"];
				$nombre_padre = utf8_encode(trim($row["nombre_padre"]).' '.trim($row["apellido_padre"]));
				$arbol = trim($nombre_padre);
				$nombre_hijo = utf8_encode(trim($row["nombre_hijo"]).' '.trim($row["apellido_hijo"]));
				$tipo_afiliado = $row["tipo_afiliado"];
				$icon = 'padre.gif';
			    $expandedIcon = 'padre.gif';
//				$nodos[$padre] = &$menu->addItem(new HTML_TreeNode(array('text' => $nombre.' - PM: '.strval(trim(number_format(rand(0,1000),0,',','.'))).' - PMO: '.strval(trim(number_format(rand(0,1000),0,',','.'))), 'link' => "test.php", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
				$nodos[$padre] = &$menu->addItem(new HTML_TreeNode(array('text' => $nombre_padre, 'link' => "", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
				$first = false;
			}
			if ($padre<>$row["padre"]) {
				$padre = $row["padre"];
				$hijo = $row["hijo"];
				$nombre_padre = utf8_encode(trim($row["nombre_padre"]).' '.trim($row["apellido_padre"]));
				$nombre_hijo = utf8_encode(trim($row["nombre_hijo"]).' '.trim($row["apellido_hijo"]));
				$tipo_afiliado = $row["tipo_afiliado"];
				switch ($tipo_afiliado) {
					case 'Premium':
					    $icon         = 'premium.gif';
					    $expandedIcon = 'premium.gif';
						break;
					case 'VIP':
					    $icon         = 'vip.gif';
					    $expandedIcon = 'vip.gif';
						break;
					case 'Oro':
					    $icon         = 'oro.gif';
					    $expandedIcon = 'oro.gif';
						break;
					default:
					    $icon         = 'folder.gif';
					    $expandedIcon = 'folder-expanded.gif';
						break;
				}
			}
			$hijo = $row["hijo"];
			$nombre_hijo = utf8_encode(trim($row["nombre_hijo"]).' '.trim($row["apellido_hijo"]));
			echo '<pre>padre '.$padre.' nombre_padre '.$nombre_padre.' hijo '.$hijo.' nombre_hijo '.$nombre_hijo.'<br>';
			$tipo_afiliado = $row["tipo_afiliado"];
			switch ($tipo_afiliado) {
				case 'Premium':
				    $icon         = 'premium.gif';
				    $expandedIcon = 'premium.gif';
					break;
				case 'VIP':
				    $icon         = 'vip.gif';
				    $expandedIcon = 'vip.gif';
					break;
				case 'Oro':
				    $icon         = 'oro.gif';
				    $expandedIcon = 'oro.gif';
					break;
				default:
				    $icon         = 'folder.gif';
				    $expandedIcon = 'folder-expanded.gif';
					break;
			}
//			$nodos[$hijo] = &$nodos[$padre]->addItem(new HTML_TreeNode(array('text' => $nombr2.' - PM: '.strval(trim(number_format(rand(0,1000),0,',','.'))).' - PMO: '.strval(trim(number_format(rand(500,1500),0,',','.'))), 'link' => "test.php", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
			$nodos[$hijo] = &$nodos[$padre]->addItem(new HTML_TreeNode(array('text' => $nombre_hijo, 'link' => "", 'icon' => $icon, 'expandedIcon' => $expandedIcon)));
			var_dump($nodos[$hijo]);
			echo '<br><br>';
		}
	}

    // Create the presentation class
    $treeMenu = &new HTML_TreeMenu_DHTML($menu, array('images' => 'html_tree_menu/images', 'defaultClass' => 'treeMenuDefault'));
    $listBox  = &new HTML_TreeMenu_Listbox($menu, array('linkTarget' => '_self'));
    //$treeMenuStatic = &new HTML_TreeMenu_staticHTML($menu, array('images' => '../images', 'defaultClass' => 'treeMenuDefault', 'noTopLevelImages' => true));
?>
<html>
<head>
    <style type="text/css">
        body {
            font-family: Georgia;
            font-size: 11pt;
        }
        
        .treeMenuDefault {
            font-style: italic;
        }
        
        .treeMenuBold {
            font-style: italic;
            font-weight: bold;
        }
    </style>
    <script src="html_tree_menu/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
</head>
<body>

<h3><u>Genealogía de <?php echo $arbol; ?></u></h3>
<p>Leyenda: <img src="html_tree_menu/images/padre.gif" style="vertical-align:-55%;"> Organización | <img src="html_tree_menu/images/premium.gif" style="vertical-align:-50%;"> Premium | <img src="html_tree_menu/images/vip.gif" style="vertical-align:-50%;"> VIP | <img src="html_tree_menu/images/oro.gif" style="vertical-align:-50%;"> Oro</p>
<!--<?$listBox->printMenu()?>-->
<?$treeMenu->printMenu()?><br /><br />


<script type="text/javascript">
	function aviso(){
		alert('PM: XXXX\nPMO: YYY');		
	}
</script>

</body>
</html>
