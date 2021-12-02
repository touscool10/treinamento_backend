<?php require_once("../../conexao/conexao.php"); ?>
<?php include_once("../_incluir/funcoes.php"); ?>


<?php
    #$respostas = "";
    if ( isset($_POST["Enviar"] ) ) {
        
        $respostas = publicarArquivo($_FILES["upload_file"], "images/product_images");
        #echo "<pre>";
        #print_r($respostas);
        #echo "</pre>";
        $mensagemm      = $respostas[0];
        $nom_fichier    = $respostas[1];       
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Upload</title>

    <!-- Estilo  -->
    <link href="_css/alteracao.css" rel="stylesheet">
    <link href="_css/estilo.css" rel="stylesheet">

    <style>
            input   {
                display:block;
                margin-bottom:15px;
            }
    </style>

</head>
<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <main>
        <div id="janela_formulario">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                
                <input type="hidden" name="MAX_FILE_SIZE" value="45000000">
                <input type="file" name="upload_file" accept="image/jpeg, image/gif, image/png">
                <input type="submit" name="Enviar">

            </form>
            <?php
                echo "</br>"."</br>";
                if ( isset($respostas) ) {
                    echo "{$mensagemm}";
                    echo "</br>";
                    echo "{$nom_fichier}";

                }
                
            ?>
        </div>
    </main>
    <?php include_once("../_incluir/rodape.php"); ?>
</body>
</html>

<?php mysqli_close($conecta); ?>
