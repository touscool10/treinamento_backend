<?php
    //Passo 1 
    $servidor     = "localhost";
    $usuario      = "root";
    $senha        = "";
    $banco        = "andes";
    $conecta      = mysqli_connect($servidor,$usuario,$senha,$banco);

    if (mysqli_connect_errno()) {
        die("Conexão Falhou : " . mysqli_connect_errno());
    }       
?>