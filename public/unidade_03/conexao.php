<?php
    require_once("../../conexao/conexao.php");        
?>

<?php 
    

    //Passo 2
    $consulta_produtos = "SELECT nomeproduto, descricao, precounitario, tempoentrega ";
    $consulta_produtos .= " FROM produtos";
    $produtos = mysqli_query($conecta, $consulta_produtos);

    if (!$produtos) {
        die("Falha na consulta ao banco de dados");
    }


?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
    </head>

    <body>
    
        <?php
            while ($registro = mysqli_fetch_row($produtos)) {
                print_r($registro);
                echo "<br>";

            }
        ?>
               
        <?php
            
            mysqli_free_result($produtos);
        ?>

    </body>
</html>

<?php
    mysqli_close($conecta);
?>