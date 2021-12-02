<header>
    <div id="header_central">
        <?php
            if (isset($_SESSION["user_portal"])) { 
                
                $user = $_SESSION["user_portal"];
                $saudacao       = "SELECT nomecompleto  ";
                $saudacao      .= " FROM clientes ";
                $saudacao      .= " WHERE clienteID = {$user} ";
                $saudacao_login = mysqli_query($conecta,$saudacao);
                if (!$saudacao_login) {
                    die("Falha no banco de dadosfuc");
                }

                $saudacao_login_result = mysqli_fetch_assoc($saudacao_login);
                $nome                  = $saudacao_login_result["nomecompleto"];
                
        ?>

        <div id="header_saudacao">
            <h5>Seja bem-vindo(a), <?php echo $nome ?> | <a href="logout.php"> Sair</a> </h5>
            <!-- <a href="../unidade_07/logout.php">Sair</a> -->
        </div>

        <?php
            }
        ?>


        <img src="/avancado/public/_assets/logo_andes.gif">
        <img src="/avancado/public/_assets/text_bnwcoffee.gif">
    </div>
</header>