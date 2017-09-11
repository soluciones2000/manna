<?php

// Comentario
	function asignacodigo($ultcodigo){
		$valores = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$codigo = '';
		$arriba = 1;
		$newcodigo = '';
		$numero = $ultcodigo->ultcodigo;
		for ($i=strlen($numero)-1 ; $i>=0 ; $i--) { 
			$pos = strpos($valores, substr($numero,$i,1));
			$a = strlen($valores)-1;
			if ($arriba==1) {
				if ($pos==strlen($valores)-1) {
					$codigo = substr($valores,0,1);
				} else {
					$codigo = substr($valores,$pos+1,1);
					$arriba = 0;
				}
			} else {
				$codigo = substr($numero,$i,1);
			}
			$newcodigo = $codigo.$newcodigo;
		}		
		return $newcodigo;
	}

// Comentario
	function asignacodclte($ultcodigo){
		$valores = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$codigo = '';
		$arriba = 1;
		$newcodigo = '';
		$numero = $ultcodigo->ultcodigo;
		$numero = (strlen($numero)<=0) ? "00000" : $numero ;
		for ($i=strlen($numero)-1 ; $i>=0 ; $i--) { 
			$pos = strpos($valores, substr($numero,$i,1));
			$a = strlen($valores)-1;
			if ($arriba==1) {
				if ($pos==strlen($valores)-1) {
					$codigo = substr($valores,0,1);
				} else {
					$codigo = substr($valores,$pos+1,1);
					$arriba = 0;
				}
			} else {
				$codigo = substr($numero,$i,1);
			}
			$newcodigo = $codigo.$newcodigo;
		}		
		return $newcodigo;
	}

?>