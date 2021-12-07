<?php

    function real_format($valor) {
        $valor  = number_format($valor,2,",",".");
        return $valor;
    }

    function GerarCodigo(){
    	$alfabeto  = "01234569ABCDEFGHIJKLMNOPQRSTUVXWYZ";
    	$tamanho   = 12;
    	$letra     = "";
    	$resultado = "";

    	for ($i=0; $i <= $tamanho; $i++) { 
    		$letra = substr($alfabeto, rand(0,36),1);
    		$resultado .= $letra; 
    	}

    	date_default_timezone_set("America/Sao_Paulo");
    	$agora       = getdate();
    	$codigo_data = $agora["year"]."".$agora["yday"]."".$agora["hours"]."".$agora["minutes"]."".$agora["seconds"];

        return $codigo_data."_".$resultado;

    }
?>