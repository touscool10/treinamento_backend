<?php require_once("../../conexao/conexao.php"); ?>
<?php include_once("../_incluir/funcoes.php"); ?>



<?php 
echo "test";

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de contato</title>
    <!--Estilo-->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/contato.css" rel="stylesheet">

</head>
<body>
    <?php include_once("../_incluir/topo.php"); ?>
        <main>
            <div id="janela_formulario">
                <form action="contato.php" method="post">
                    <input type="text" name="nome" placeholder="Digite seu nome">
                    <input type="email" name="e_mail" placeholder="Digite seu email">
                    <label>Mensagem</label>
                    <textarea name="mensagem"></textarea>
                    <input type="submit" name="enviar" value="Enviar Mensagem">

                    <?php 
                        
                    ?>
                </form>
            </div>
        </main>
    <?php include_once("../_incluir/rodape.php"); ?>
    </body>
</html>

<?php
    mysqli_close($conecta);
?>
