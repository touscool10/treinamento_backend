<?php require_once("../../conexao/conexao.php"); ?>
<?php include_once("../_incluir/funcoes.php"); ?>


<?php 
//Verificar se os dados vieram do formulário
if (isset($_POST["submeter"])) {
    if (   isset($_POST["nomeproduto"])   &&  isset($_FILES) ) {
         
            $diretorio = "images/product_images";
            $resultImagemGrande = publicarArquivo($_FILES["imagemgrande"], $diretorio);
            $resultImagemPequena = publicarArquivo($_FILES["imagempequena"], $diretorio);
            $mensagem1 = $resultImagemGrande[0];
            $mensagem2 = $resultImagemPequena[0];

        
        
        $nomeproduto      = $_POST["nomeproduto"];
        $codigobarra      = $_POST["codigobarra"];
        $tempoentrega     = $_POST["tempoentrega"];
        $precorevenda     = $_POST["precorevenda"];
        $precounitario    = $_POST["precounitario"];
        $imagemgrande     = $diretorio."/". $resultImagemGrande[1];
        $imagempequena    = $diretorio."/". $resultImagemPequena[1];
        $fornecedorID     = $_POST["fournisseur"];
        $categoriaID      = $_POST["categorie"];
        
      

        

        /*INSERT INTO nome_tabela (coluna1, coluna2,...)VALUES (valor1, valor2,...);*/
        $inserir        = "INSERT INTO produtos ";
        $inserir       .= " (nomeproduto, imagemgrande, imagempequena, categoriaID, fornecedorID, tempoentrega, codigobarra, precounitario, precorevenda) ";
        $inserir       .= "  VALUES ('$nomeproduto', '$imagemgrande', '$imagempequena', $categoriaID, $fornecedorID, $tempoentrega, '$codigobarra', $precounitario, $precorevenda) ";

        $consulta_insercao = mysqli_query($conecta, $inserir);
        if (!$consulta_insercao) {
            die("Erro na inserção do novo produto no banco");
        }   else    {
                //header("location:listagem.php");
                $mensagem_sucesso = "Produto inserido com sucesso";
            }

    }   else {
        header("location:incluir.php");
    }

    
}

//Categoria do produto a ser  incluido
$_categoria_        ="SELECT * FROM categorias ";
$consulta_categoria = mysqli_query($conecta,$_categoria_);
if (!$consulta_categoria) {
    die("Erro na consulta de categorias no banco");
}   

//Fornecedor do produto a ser incluido
$_fornecedor_        ="SELECT fornecedorID, nomefornecedor FROM fornecedores ";
$consulta_fornecedor_ = mysqli_query($conecta,$_fornecedor_);
if (!$consulta_fornecedor_) {
    die("Erro na consulta dos fornecedores no banco");
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir novo produto</title>

    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/inclusao.css" rel="stylesheet">

</head>
<body>
    <?php include_once("../_incluir/topo.php") ?>
        <main>
            <div id="janela_formulario">
                <form action="incluir.php" method="post" enctype="multipart/form-data">
                    <h2>Incluir Novo Produto</h2>
                    
                    <input type="text" name="nomeproduto" placeholder="Nome do Produto">
                    <input type="text" name="codigobarra" placeholder="Codigo de Barra">
                    
                    <legend>Tempo de Entrega</legend>
                    <input type="radio" name="tempoentrega" value="5">
                    5 dias
                    <input type="radio" name="tempoentrega" value="8">
                    8 dias
                    <input type="radio" name="tempoentrega" value="15">
                    15 dias
                    <input type="radio" name="tempoentrega" value="30">
                    30 dias
                    
                    <legend>Selecione a categoria do produto</legend>
                    <select name="categorie">
                        <?php 
                            while ($linha = mysqli_fetch_assoc($consulta_categoria)) {
                        ?>
                            <option value="<?php echo $linha["categoriaID"]; ?>"> <?php echo $linha["nomecategoria"]; ?> </option>

                        <?php
                            }
                        ?>
                    </select>
                    
                    <legend>Selecione o fornecedor do produto</legend>
                    <select name="fournisseur">
                        <?php 
                            while ($linha_f = mysqli_fetch_assoc($consulta_fornecedor_)) {
                        ?>
                            <option value="<?php echo $linha_f["fornecedorID"]; ?>"> <?php echo $linha_f["nomefornecedor"]; ?> </option>

                        <?php
                            }
                        ?>
                    </select>

                    <input type="text" name="precorevenda" placeholder="Preço Revenda">
                    <input type="text" name="precounitario" placeholder="Preço Unitário">
                    
                    <legend>Foto Grande</legend>
                    <input type="file" name="imagemgrande" accept="image/jpeg, image/gif, image/png">
                    <?php 
                        if ( isset($mensagem_sucesso) && isset($mensagem1)) {
                            //echo $mensagem1;
                        }
                    ?> 

                    <legend>Foto Pequena</legend>
                    <input type="file" name="imagempequena" accept="image/jpeg, image/gif, image/png">
                    <?php 
                        if ( isset($mensagem_sucesso) && isset($mensagem2) ) {
                            //echo $mensagem2;
                        }
                    ?>               
                    
                    <input type="submit" name="submeter" value="Inserir novo produto">
                   
                        <?php 
                            if ( isset($mensagem_sucesso) ) {
                                
                        ?> 
                         <p>Produto inserido com sucesso</p>
                         <?php 
                           }
                        ?> 


                
                </form>
            </div>
        </main>
    <?php include_once("../_incluir/rodape.php") ?>
</body>
</html>

<?php mysqli_close($conecta); ?>


