<?php require_once("../../conexao/conexao.php"); ?>


<?php 
    //Testar se o parâmetro foi definido/enviado
    if (isset($_GET["codigo"])) {
        $codigo = $_GET["codigo"];
    } else {
        Header("Location: listagem.php");
    }
?>
<?php
    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= " FROM produtos WHERE produtoID = {$codigo}";
    $resultado = mysqli_query($conecta, $consulta);
    if(!$resultado) {
        die("Falha na consulta ao banco");   
    } else {
        $all_details = mysqli_fetch_assoc($resultado);
                    $nomeproduto      = $all_details["nomeproduto"] ;
                    $produtoID        = $all_details["produtoID"] ;
                    $descricao        = $all_details["descricao"] ;
                    $codigobarra      = $all_details["codigobarra"] ;                
                    $tempoentrega     = $all_details["tempoentrega"] ;
                    $precorevenda     = $all_details["precorevenda"] ;
                    $precounitario    = $all_details["precounitario"] ;
                    $estoque          = $all_details["estoque"] ;
                    $descontinuado    = $all_details["descontinuado"] ;
                    $fornecedorID     = $all_details["fornecedorID"] ;
                    $categoriaID      = $all_details["categoriaID"] ;
                    $imagemgrande    = $all_details["imagemgrande"];
        }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/produto_detalhe.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?>
         
        
        <main> 
                    <div id="detalhe_produto"> 
                    
                        <ul>
                            <li class=imagem><img src="<?php echo $imagemgrande ?>" ></li>
                            <li><h2><?php echo $nomeproduto   ?></h2></li>
                            <li><?php echo $produtoID     ?></li>
                            <li><?php echo $descricao     ?></li>
                            <li>Codigo de barra: <?php echo $codigobarra   ?></li>
                            <li>Tempo de entraga: <?php echo $tempoentrega  ?> dias</li>
                            <li>Preço de venda: <?php echo real_format($precorevenda)  ?></li>
                            <li>Preço unitário: <?php echo real_format($precounitario) ?></li>
                            <li>Estoque: <?php echo $estoque       ?></li>

                        </ul>
                            
                    </div>              
        
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>