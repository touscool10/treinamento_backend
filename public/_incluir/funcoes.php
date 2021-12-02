<?php
    function real_format($valor) {
        $valor  = number_format($valor,2,",",".");
        return "R$ " . $valor;
    }

    function mostrarMsgErro($codigo_erro) {
        $array_erro = array(
            UPLOAD_ERR_OK => "Arquivo publicado com sucesso.",
            UPLOAD_ERR_INI_SIZE => "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
            UPLOAD_ERR_FORM_SIZE => "O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML",
            UPLOAD_ERR_PARTIAL => "O upload do arquivo foi feito parcialmente.",
            UPLOAD_ERR_NO_FILE => "Nenhum arquivo foi enviado.",
            UPLOAD_ERR_NO_TMP_DIR => "Pasta temporária ausente.",
            UPLOAD_ERR_CANT_WRITE => "Falha em escrever o arquivo em disco.",
            UPLOAD_ERR_EXTENSION => "Uma extensão do PHP interrompeu o upload do arquivo."
        ); 
        return $array_erro[$codigo_erro];
    }

    function publicarArquivo($arquivo_publicado, $pasta_destino) {
        if ( $arquivo_publicado["error"] == 0 ) {
            $pasta_temporaria               = $arquivo_publicado["tmp_name"] ;
            $pasta                          = $pasta_destino; 
            $name_file                      = alterarNome($arquivo_publicado["name"]) ;
            $tipo_arquivo                   = $arquivo_publicado["type"] ;
            $extensao_arquivo               = strrchr($name_file,".");

            if ( $tipo_arquivo == "image/jpeg" || $tipo_arquivo == "image/gif" || $tipo_arquivo == "image/png"  ) {
                if ( move_uploaded_file($pasta_temporaria, $pasta_destino."/".$name_file) ) {
                    #$message = "deu bom upload";
                    $message = mostrarMsgErro($arquivo_publicado["error"]);
                }   else {
                        $message = "Arquivo não foi publicado.";# code...
                    }
            }   else {
                $message = "A extensão do arquivo não pode ser $extensao_arquivo";# code...
            }
            
            
        }   else {
                $message = mostrarMsgErro($arquivo_publicado["error"]);
            }
        return array($message,$name_file);
    }

    function alterarNome($arquivo) {
        $extensao_arquivo   = strrchr($arquivo,".");
        $alfabeto           = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $tamanho            = 15;
        $letra              = "";
        $result             = "";
        for ($i=0; $i < $tamanho; $i++) { 
            $letra = substr($alfabeto,rand(0, strlen($alfabeto)-1),1);
            $result .= $letra;
        }
    
        $now = getdate();
    #    echo "<pre>"; 
    #       print_r($now);
    #    echo "</pre>";
        $codigo_ano = $now["year"]."_".$now["yday"];
        $codigo_data = $now["hours"].$now["minutes"].$now["seconds"];
        $result .= "_".$codigo_ano."_".$codigo_data;
        return "foto_".$result.$extensao_arquivo;

    }
    
?>