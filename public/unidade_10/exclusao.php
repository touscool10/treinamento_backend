<?php require_once("../../conexao/conexao.php"); ?>

<?php
    #Excluir Transportadora
    if ( isset($_POST["cidade"]) ) {
        $transpor_id = $_POST["transportadoraID"];
        # Objeto de exclusão
        $exclusao  = " DELETE FROM transportadoras ";
        $exclusao .= " WHERE transportadoraID = {$transpor_id}";

        $cons_exclusao = mysqli_query($conecta,$exclusao);
        if (!$cons_exclusao) {
            die("Falha ao excluir no banco de dados");
        }   else {
                header("location:listagem.php");
            }
    } 
    
    #Exibir dados da transportadora a ser excluida
    if ( isset($_GET["codigo"]) ) {
        $transp_id = $_GET["codigo"];

        # Monstrar os dados da transportadora a ser excluida
        $show_tr_exluir  = "SELECT * FROM transportadoras ";
        $show_tr_exluir .= " WHERE transportadoraID = {$transp_id}";
        $oper_show_tr_exluir = mysqli_query($conecta,$show_tr_exluir);
        if (!$oper_show_tr_exluir) {
            die("Falha na consulta ao banco");
        }   else {
                $linha_tr_excluir = mysqli_fetch_assoc($oper_show_tr_exluir);
                #print_r($linha_tr_excluir);
            }

        //Estado
        $state  = " SELECT estadoID, nome ";
        $state .=" FROM estados WHERE estadoID = {$linha_tr_excluir["estadoID"]} ";
        $con_state = mysqli_query($conecta,$state);
        if (!$con_state) {
            die("Falha na conexão ao banco");
        }   else {
                $line_state = mysqli_fetch_assoc($con_state);
                #print_r($line_state);
            }

    }   else {
        header("location:listagem.php");
        }


?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Página de exclusão da transportadora</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css"         rel="stylesheet">
        <link href="_css/alteracao.css"      rel="stylesheet">
        <link href="_css/novo-alteracao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  

            <div id="janela_formulario">
                <form action="exclusao.php" method="post">
                    <h2>Exclusão de Transportadora</h2>
                    
                    <label for="nometransportadora">Nome da transportadora</label>
                    <input type="text" name="nometransportadora" value="<?php echo utf8_encode($linha_tr_excluir["nometransportadora"]) ?>">

                    <label for="endereço">Endereço</label>
                    <input type="text" name="endereco" value="<?php echo utf8_encode($linha_tr_excluir["endereco"]) ?>">
                    
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" value="<?php echo utf8_encode($linha_tr_excluir["cidade"]) ?>">
                    
                    <label for="estados">Estado</label>
                    <select name="estados" id="estados">
                        <option value="<?php echo $line_state["estadoID"] ?>">
                            <?php echo utf8_encode($line_state["nome"]) ?>
                        </option>
                    </select>

                    <input type="hidden" name="transportadoraID" value="<?php echo $linha_tr_excluir["transportadoraID"] ?>">
                    <input type="submit" value="Confirmar Exclusão">
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