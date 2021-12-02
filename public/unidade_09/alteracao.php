<?php require_once("../../conexao/conexao.php") ?>

<?php 
        //Atualizando os dados da transportadora
        if( isset($_POST["cidade"]) ){
        #Pegando os dados enviados pelo formulário 
            $nome_               = $_POST["nometransportadora"];
            $endereco_           = $_POST["endereco"];
            $cidade_             = $_POST["cidade"];
            $estado_             = $_POST["estados"];
            $cep_                = $_POST["cep"];
            $telefone_           = $_POST["telefone"];
            $cnpj_               = $_POST["cnpj"];
            $t_id                = $_POST["transportadoraID"];
        # Criando o objeto de Alteração no BD
            $alterar = "UPDATE transportadoras ";
            $alterar .= " SET nometransportadora = '{$nome_}', endereco = '{$endereco_}', ";
            $alterar .= " telefone = '{$telefone_}', cidade = '{$cidade_}', estadoID = {$estado_}, ";
            $alterar .= " cep = '{$cep_}', cnpj = '{$cnpj_}' ";
            $alterar .= " WHERE transportadoraID = {$t_id}";
        #Fazendo uma QUERY para de fato executar a alteração no BD
            $operacao_update_transp = mysqli_query($conecta,$alterar);
            if (!$operacao_update_transp) {
                die("Falha na atualização da transportadora no banco");
            }	else {
                    header("location:listagem.php");
                }

        }	




    //Pegando dados da atual transportadora para preenchimento
    if ( isset($_GET["codigo"]) ) {

        $id_transportadora  = $_GET["codigo"];
        //consultando banco para pegar dados da atual transportadora
        $consultar  = " SELECT * FROM transportadoras ";
        $consultar .= " WHERE transportadoraID = {$id_transportadora} ";
        $operacao_consultar = mysqli_query($conecta,$consultar);
        if (!$operacao_consultar) {
            die("Falha na conexão ao banco para consulta a tabela transportadoras");
        }   else {
                $a_linha_transp = mysqli_fetch_assoc($operacao_consultar);   
                #print_r($a_linha_transp); 
            }

        //Pegando dados do estado atual
        $estado_s  = " SELECT estadoID, nome FROM estados ";
        #$estado_s .= " WHERE estadoID = {$a_linha_transp["estadoID"]} ";
        $operacao_estado_atual = mysqli_query($conecta,$estado_s);
        if (!$operacao_estado_atual) {
            die("Falha na conexão ao banco para consulta de estado atual");
        }   /*else {
                $a_linha_estados = mysqli_fetch_assoc($operacao_estado_atual);   
                #print_r($a_linha_estados);
                 
            }*/

        
        

        
    }   else {
            header("location:listagem.php");
        }
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Pagina de Alteração de Transportadora</title>
    <!-- estilo -->
    <link href="_css/estilo.css"              rel="stylesheet">
    <link href="_css/alteracao.css"           rel="stylesheet">
    
  
</head> 
<body>
    <?php include("../_incluir/topo.php") ?>
    <?php include("../_incluir/funcoes.php") ?>
        
                <main>
                    <div id="janela_formulario">
                        <form action="alteracao.php" method="post">    
                            
                            <h2>Alteração de Transportadora</h2>
                            
                            <label for="nometransportadora">Nome da Transportadora</label>
                            <input type="text" value="<?php echo utf8_encode($a_linha_transp["nometransportadora"]); ?>" name="nometransportadora">
                            
                            <label for="endereco">Endereço</label>
                            <input type="text" value="<?php echo utf8_encode($a_linha_transp["endereco"]); ?>" name="endereco">
                            
                            <label for="cidade">Cidade</label>
                            <input type="text" value="<?php echo utf8_encode($a_linha_transp["cidade"]); ?>" name="cidade">

                            <label for="estados">Estados</label>
                            <select id="estados" name="estados">
                                <?php 
                                    $mystate = $a_linha_transp["estadoID"];
                                    while ($row = mysqli_fetch_assoc($operacao_estado_atual)) {
                                        $estado_momento = $row["estadoID"];
                                        if ($estado_momento == $mystate) { 
                                ?>   
                                    <option value="<?php echo $row["estadoID"]; ?>" selected>
                                        <?php echo utf8_encode($row["nome"]); ?>
                                    </option>
                                <?php 
                                        }   else { 
                                ?>
                                    <option value="<?php echo $row["estadoID"]; ?>">
                                        <?php echo utf8_encode($row["nome"]); ?>
                                    </option>
                                <?php       } 
                                
                                    }
                                ?>
                                
                            </select>

                            <label for="cep">CEP</label>
                            <input type="text" value="<?php echo utf8_encode($a_linha_transp["cep"]); ?>" name="cep">
                            
                            <label for="telefone">Telefone</label>
                            <input type="text" value="<?php echo utf8_encode($a_linha_transp["telefone"]); ?>" name="telefone">
                            
                            <label for="cnpj">CNPJ</label>
                            <input type="text" value="<?php echo utf8_encode($a_linha_transp["cnpj"]); ?>"  name="cnpj">

                            <input type="hidden" name="transportadoraID" value="<?php echo $_GET["codigo"] ?>">
                                                       
                            <input type="submit" value="Confirmar Alteração">
                        </form>
                    </div>
                </main>
  

    <?php include("../_incluir/rodape.php") ?>
</body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>
