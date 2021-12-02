<?php

    $alfabeto = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $tamanho    = 15;
    $letra = "";
    $result     = "";
    for ($i=0; $i < $tamanho; $i++) { 
        $letra = substr($alfabeto,rand(0, strlen($alfabeto)-1),1);
        $result .= $letra;
    }

    $now = getdate();
#    echo "<pre>"; 
#       print_r($now);
#    echo "</pre>";
    $codigo_ano = $now["year"]."_".$now["yday"];
    $codigo_data = $now["hours"].$now["minutes"].$now["seconds"];
    $result .= "_".$codigo_ano."_".$codigo_data;
    echo $result;

?>