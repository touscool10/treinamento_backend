<?php require_once("../../conexao/conexao.php"); ?>

<?php 
    //inserção no banco
    if ( isset($_POST["cidade"]) ) {
        $nome           = $_POST["nometransportadora"];
        $endereco       = $_POST["endereco"];
        $cidade         = $_POST["cidade"];
        $o_estado       = $_POST["estados"];
        $cep            = $_POST["cep"];
        $cnpj           = $_POST["cnpj"];
        $telefone       = $_POST["telefone"];
        

       /* $apagar         = "DELETE FROM transportadoras ";
        $apagar        .= " WHERE transportadoraID IN (4,5,6,7,8,9,10,11,12)";
                
        $operacao_apagar = mysqli_query($conecta,$apagar);
        if (!$operacao_apagar) {
            die("Falha ao apagar dados no banco");
        }*/

        
        $inserir         = "INSERT INTO transportadoras ";
        $inserir        .= " (nometransportadora, endereco, telefone, cidade, estadoID, cep, cnpj) ";
        $inserir        .= " VALUES ('$nome','$endereco','$telefone','$cidade',$o_estado,'$cep','$cnpj')";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if (!$operacao_inserir) {
            die("Falha na inserção no banco");
        }   else {
                header("location:listagem.php");
            }
    }
    
    
    //seleção de estados
    $states = "SELECT nome, estadoID FROM estados";
    $linha_estados = mysqli_query($conecta,$states);
    if ( !$linha_estados ) {
        die("Falha na consulta ao banco");
    }
    

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    </head>


    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id ="janela_formulario">
                <form action="inserir.php" method="post">
                    <input type="text" name="nometransportadora" placeholder="Nome">
                    <input type="text" name="endereco" placeholder="Endereço">
                    <input type="text" name="cidade" placeholder="Cidade">

                    <select name="estados">
                        <?php while ($linha = mysqli_fetch_assoc($linha_estados)) { ?>
                                
                                <option value="<?php echo $linha["estadoID"]; ?>">
                                    <?php echo utf8_encode($linha["nome"]); ?>
                                </option>
                            
                        <?php } ?> 
                    </select>


                    <input type="text" name="telefone" placeholder="Telefone">
                    <input type="text" name="cep" placeholder="CEP">
                    <input type="text" name="cnpj" placeholder="CNPJ">
                    <input type="submit" value="inserir">
                </form>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>