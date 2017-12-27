<?php
session_start(); 
include_once("conexion.php");
$codigo = $_POST['c'];
// $codigo = '00000';
$where = "";
$query = "select tit_nombres, tit_apellidos, email from afiliados where tit_codigo<>'".trim($codigo)."'";

$cond ='';
foreach ($_POST as $key => $value) {
   $cond .= '***'.$key.'='.$value;
}
$todos = "";
if ($_POST["todalared"]) { $todos = "si-todos"; } else { $todos = "no-todos"; }
if ($_POST["rngall"]) { $todos .= " si-rangos"; } else { $todos .= " no-rangos"; }
if ($_POST["tipall"]) { $todos .= " si-tipos"; } else { $todos .= " no-tipos"; }
if ($_POST["nivall"]) { $todos .= " si-niveles"; } else { $todos .= " no-niveles"; }
if ($_POST["sexall"]) { $todos .= " si-sexos"; } else { $todos .= " no-sexos"; }
if ($_POST["edtodos"]) { $todos .= " si-edades"; } else { $todos .= " no-edades"; }
if ($_POST["persall"]) { $todos .= " si-personas"; } else { $todos .= " no-personas"; }
if ($_POST["nactodos"]) { $todos .= " si-nacionalidades"; } else { $todos .= " no-nacionalidades"; }
if ($_POST["edocall"]) { $todos .= " si-edociviles"; } else { $todos .= " no-edociviles"; }
if ($_POST["estall"]) { $todos .= " si-estados"; } else { $todos .= " no-estados"; }

//$where = $todos;

$seleccionar = true;
if ($_POST["todalared"] or $_POST["rngall"] or $_POST["tipall"] or $_POST["nivall"] or $_POST["sexall"] or $_POST["edtodos"] or $_POST["persall"] or $_POST["nactodos"] or $_POST["edocall"] or $_POST["estall"]) {
   $seleccionar = false;
   $where .= "";
} else {
   $rng = false;
   $rangos = "rango in (";
   $y = false;
   if ($_POST["rngascenso"]) { $rangos .= "'En Ascenso'"; $y = true; $rng = true; }
   if ($_POST["rnggerente"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Gerente'"; $y = true; $rng = true; }
   if ($_POST["rnggtesenior"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Gerente Senior'"; $y = true; $rng = true; }
   if ($_POST["rngoro"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Oro'"; $y = true; $rng = true; }
   if ($_POST["rngplatino"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Platino'"; $y = true; $rng = true; }
   if ($_POST["rngrubi"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Rubí'"; $y = true; $rng = true; }
   if ($_POST["rngdiamante"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Diamante'"; $y = true; $rng = true; }
   if ($_POST["rngembajador"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Embajador'"; $y = true; $rng = true; }
   if ($_POST["rngembajejec"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Embajador Ejecutivo'"; $y = true; $rng = true; }
   if ($_POST["rngembajpres"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Embajador Presidencial'"; $y = true; $rng = true; }
   if ($_POST["rngembajinter"]) { $rangos .= ($y) ? "," : "" ; $rangos .= "'Embajador Internacional'"; $rng = true; }
   $rangos .= ")";
   $where .= ($rng) ? " and ".$rangos : "" ;
   // if ($rng) {
   //    $where .= " and ".$rangos;
   // }

   $tip = false;
   $tipos = "tipo_afiliado in (";
   $y = false;
   if ($_POST["tippremium"]) { $tipos .= "'Premium'"; $y = true; $tip = true; }
   if ($_POST["tipvip"]) { $tipos .= ($y) ? "," : "" ; $tipos .= "'VIP'"; $y = true; $tip = true; }
   if ($_POST["tiporo"]) { $tipos .= ($y) ? "," : "" ; $tipos .= "'Oro'"; $tip = true; }
   $tipos .= ")";
   $where .= ($tip) ? " and ".$tipos : "" ;

   $niv = false;
   $niveles = "nivel in (";
   $y = false;
   if ($_POST["niv1"]) { $niveles .= "'1'"; $y = true; $niv = true; }
   if ($_POST["niv2"]) { $niveles .= ($y) ? "," : "" ; $niveles .= "'2'"; $y = true; $niv = true; }
   if ($_POST["niv3"]) { $niveles .= ($y) ? "," : "" ; $niveles .= "'3'"; $y = true; $niv = true; }
   if ($_POST["niv4"]) { $niveles .= ($y) ? "," : "" ; $niveles .= "'4'"; $y = true; $niv = true; }
   if ($_POST["niv5"]) { $niveles .= ($y) ? "," : "" ; $niveles .= "'5'"; $y = true; $niv = true; }
   if ($_POST["niv6"]) { $niveles .= ($y) ? "," : "" ; $niveles .= "'6'"; $y = true; $niv = true; }
   if ($_POST["niv7"]) { $niveles .= ($y) ? "," : "" ; $niveles .= "'7'"; $y = true; $niv = true; }
   if ($_POST["niv8"]) { $niveles .= ($y) ? "," : "" ; $niveles .= "'8'"; $y = true; $niv = true; }
   $niveles .= ")";
   if ($_POST["niv9"]) { $niveles .= ($y) ? " and " : "" ; $niveles .= "nivel > 8"; $niv = true; }
   $where .= ($niv) ? " and ".$niveles : "" ;

   $sex = false;
   $sexo = "sexo=";
   $y = false;
   if ($_POST["masculino"]) { $sexo .= "'masculino'"; $sex = true; }
   if ($_POST["femenino"]) { $sexo .=  "'femenino'"; $sex = true; }
   $where .= ($sex) ? " and ".$sexo : "" ;

   $eda = false;
   $edades = "";
   $y = false;
   $r = 0;
   if ($_POST["d00h20"]) {
      $dhasta = strtotime('-20 year', strtotime (date("Y-m-d")));
      $dhasta = date ( 'Y-m-d' , $dhasta );
      $edades .= "(tit_fecha_nac>='".$dhasta."')";
      $y = true;
      $r++; 
      $eda = true;
   }
   if ($_POST["d21h30"]) {
      $ddesde = strtotime('-20 year', strtotime (date("Y-m-d")));
      $ddesde = date ( 'Y-m-d' , $ddesde );
      $dhasta = strtotime('-30 year', strtotime (date("Y-m-d")));
      $dhasta = date ( 'Y-m-d' , $dhasta );
      $edades .= ($y) ? " or " : "" ;
      $edades .= "(tit_fecha_nac>='".$dhasta."' and tit_fecha_nac<'".$ddesde."')";
      $y = true; 
      $r++; 
      $eda = true;
   }
   if ($_POST["d31h40"]) {
      $ddesde = strtotime('-30 year', strtotime (date("Y-m-d")));
      $ddesde = date ( 'Y-m-d' , $ddesde );
      $dhasta = strtotime('-40 year', strtotime (date("Y-m-d")));
      $dhasta = date ( 'Y-m-d' , $dhasta );
      $edades .= ($y) ? " or " : "" ;
      $edades .= "(tit_fecha_nac>='".$dhasta."' and tit_fecha_nac<'".$ddesde."')";
      $y = true; 
      $r++; 
      $eda = true;
   }
   if ($_POST["d41h50"]) {
      $ddesde = strtotime('-40 year', strtotime (date("Y-m-d")));
      $ddesde = date ( 'Y-m-d' , $ddesde );
      $dhasta = strtotime('-50 year', strtotime (date("Y-m-d")));
      $dhasta = date ( 'Y-m-d' , $dhasta );
      $edades .= ($y) ? " or " : "" ;
      $edades .= "(tit_fecha_nac>='".$dhasta."' and tit_fecha_nac<'".$ddesde."')";
      $y = true; 
      $r++; 
      $eda = true;
   }
   if ($_POST["d51h00"]) {
      $ddesde = strtotime('-50 year', strtotime (date("Y-m-d")));
      $ddesde = date ( 'Y-m-d' , $ddesde );
      $edades .= ($y) ? " or " : "" ;
      $edades .= "(tit_fecha_nac<'".$ddesde."')";
      $y = true; 
      $r++; 
      $eda = true;
   }
   $edades = ($r>1) ? "(".$edades.")" : $edades ;
   $where .= ($eda) ? " and ".$edades : "" ;

   $per = false;
   $personas = "tipo_persona in (";
   $y = false;
   if ($_POST["persnatural"]) { $personas .= "'Natural'"; $y = true; $per = true; }
   if ($_POST["persjuridica"]) { $personas .= ($y) ? "," : "" ; $personas .= "'Jurídico'"; $y = true; $per = true; }
   if ($_POST["persespecialista"]) { $personas .= ($y) ? "," : "" ; $personas .= "'Especialista'"; $per = true; }
   $personas .= ")";
   $where .= ($per) ? " and ".$personas : "" ;

   $nac = false;
   $nacionalidad = "nacionalidad=";
   $y = false;
   if ($_POST["local"]) { $nacionalidad .= "'Local'"; $nac = true; }
   if ($_POST["extranjero"]) { $nacionalidad .=  "'Extranjero'"; $nac = true; }
   $where .= ($nac) ? " and ".$nacionalidad : "" ;

   $edc = false;
   $edocivil = "tit_edo_civil in (";
   $y = false;
   if ($_POST["soltero"]) { $edocivil .= "'soltero'"; $y = true; $edc = true; }
   if ($_POST["casado"]) { $edocivil .= ($y) ? "," : "" ; $edocivil .= "'casado'"; $y = true; $edc = true; }
   if ($_POST["divorciado"]) { $edocivil .= ($y) ? "," : "" ; $edocivil .= "'divorciado'"; $y = true; $edc = true; }
   if ($_POST["edocotro"]) { $edocivil .= ($y) ? "," : "" ; $edocivil .= "'otro'"; $edc = true; }
   $edocivil .= ")";
   $where .= ($edc) ? " and ".$edocivil : "" ;

   $edo = false;
   $estado = "estado in (";
   $y = false;
   $quer3 = 'select estado from estados order by estado';
   $resul3 = mysql_query($quer3,$link);
   while ($ro3 = mysql_fetch_array($resul3)) {
      if ($_POST[$ro3["estado"]]) { $estado .= ($y) ? "," : "" ; $estado .= "'".trim($ro3["estado"])."'"; $y = true; $edo = true; }
   }
   $estado .= ")";
   $where .= ($edo) ? " and ".$estado : "" ;
}

$quer4 = "select email from afiliados where tit_codigo='".trim($codigo)."'";
$resul4 = mysql_query($quer4,$link);
$ro4 = mysql_fetch_array($resul4);

$cabeceras = "From: ".$ro4["email"]."; Content-type: text/html;";

// $quer2 = "insert into mensajes (codigo,mensaje) values ('".$codigo."','".$query.$where."')";
// //$quer2 = "insert into mensajes (codigo,mensaje) values ('00000','prueba')";
// $resul2 = mysql_query($quer2,$link);

$query .= $where;
echo $query.'<br>';
echo $quer4.'<br>';
echo $quer2.'<br>';

//$quer2 = "insert into mensajes (codigo,mensaje) values ('".$codigo."','".$query."')";
      // //$quer2 = "insert into mensajes (codigo,mensaje) values ('00000','prueba')";
//$resul2 = mysql_query($quer2,$link);

$result = mysql_query($query,$link);

if ($seleccionar) {
   if (strlen($where)>0) {
      while ($row = mysql_fetch_array($result)) {
         if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {             
            mail($row["email"],$_POST["asunto"],$_POST["cuerpo"],$cabeceras);
         }
//         $quer2 = "insert into mensajes (codigo,mensaje) values ('".$codigo."','".$row["email"]."')";
         // //$quer2 = "insert into mensajes (codigo,mensaje) values ('00000','prueba')";
//         $resul2 = mysql_query($quer2,$link);
      }
   }
} else {
   while ($row = mysql_fetch_array($result)) {
      if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {             
         mail($row["email"],$_POST["asunto"],$_POST["cuerpo"],$cabeceras);
      }
//      $quer2 = "insert into mensajes (codigo,mensaje) values ('".$codigo."','".$row["email"]."')";
      // //$quer2 = "insert into mensajes (codigo,mensaje) values ('00000','prueba')";
//      $resul2 = mysql_query($quer2,$link);
   }
}

$emails = (isset($_POST["emails"])) ? $_POST["emails"] : "" ;
$pos = 0;
$arb = 0;
$pto = 0;
$dirx = "";
$ini = 0;
if (strlen($emails)>0) {
   echo "si<br>";
   echo 'len '.strlen($emails).'<br>';
   for ($i=0; $i < strlen($emails); $i++) {
      $pos = strpos($emails,',',$ini);
      echo 'pos '.$pos.'<br>';
      if ($pos>0 and $pos<=strlen($emails)) {
         $dirx = substr($emails,$i,$pos);
         $arb = strpos($dirx,'@');
         $pto = strpos($dirx,'.',$arb);
         $i = $ini+strlen($dirx);
         $ini = $i;
         echo 'i '.$i.'<br>';
         echo 'pos '.$pos.'<br>';
         echo 'dirx '.$dirx.'<br>';
         echo 'arb '.$arb.'<br>';
         echo 'pto '.$pto.'<br>';
         echo 'i '.$i.'<br>';
         echo 'ini '.$ini.'<br>';
         if ($arb>0 and $pto>0) {
            echo 'envio<br>';
            if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {             
               mail($dirx,$_POST["asunto"],$_POST["cuerpo"],$cabeceras);
            }
//            $quer2 = "insert into mensajes (codigo,mensaje) values ('".$codigo."','".$dirx."')";
//            $quer2 = "insert into mensajes (codigo,mensaje) values ('00000','".$dirx."')";
            echo $quer2.'<br><br>';
            //$quer2 = "insert into mensajes (codigo,mensaje) values ('00000','prueba')";
//            $resul2 = mysql_query($quer2,$link);
         }
      } else {
         $dirx = $emails;         
         $arb = strpos($dirx,'@');
         $pto = strpos($dirx,'.',$arb);
         $i = $ini+strlen($dirx);
         $ini = $i;
         echo 'i '.$i.'<br>';
         echo 'pos '.$pos.'<br>';
         echo 'dirx '.$dirx.'<br>';
         echo 'arb '.$arb.'<br>';
         echo 'pto '.$pto.'<br>';
         echo 'i '.$i.'<br>';
         echo 'ini '.$ini.'<br>';
         if ($arb>0 and $pto>0) {
            echo 'envio<br>';
            if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {             
               mail($dirx,$_POST["asunto"],$_POST["cuerpo"],$cabeceras);
            }
//            $quer2 = "insert into mensajes (codigo,mensaje) values ('".$codigo."','".$dirx."')";
//            $quer2 = "insert into mensajes (codigo,mensaje) values ('00000','".$dirx."')";
            echo $quer2.'<br><br>';
            //$quer2 = "insert into mensajes (codigo,mensaje) values ('00000','prueba')";
//            $resul2 = mysql_query($quer2,$link);
         }
      }
   }
} else {
   echo "no";
}

// $quer2 = 'insert into mensajes (codigo,mensaje) values ("'.$codigo.'","'.$query.$where.'")';
// //$quer2 = "insert into mensajes (codigo,mensaje) values ('00000','prueba')";
// $resul2 = mysql_query($quer2,$link);
?>