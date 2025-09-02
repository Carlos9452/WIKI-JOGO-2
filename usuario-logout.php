<?php
    // Apaga os dados da sessão

    // Inicia a sessão
    session_start();

    // Apaga os dados salvos
    session_unset();

    // Apaga a sessão
    session_destroy();

    // Volta para a página de login
    header("location: usuario-login.php");
?>