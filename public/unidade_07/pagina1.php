<?php require_once("../../conexao/conexao.php"); ?>

<?php
    //Criar inicializacao da variável de sessão.
    session_start();
    //definir valor
    $_SESSION["usuario"] = "Vanessa";
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?>
        
        <main>
            <?php
                echo $_SESSION["usuario"];
            ?>

            <p>
                <a href="pagina2.php">Pagina 2</a>  
            </p>

        </main>

        <?php include_once("../_incluir/rodape.php"); ?> 
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>