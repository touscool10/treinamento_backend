<?php
    // Fechar uma variável de sessão
    session_start();
    unset($_SESSION["user_portal"]);
    header("location:login.php");
?>

