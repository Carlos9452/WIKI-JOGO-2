<?php session_start();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki Bullet Symphony - Página Principal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Wiki Bullet Symphony</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pages/mecanicas.html">Mecânicas</a></li>
                <?php if (!isset($_SESSION["nome_usuario"])){?>
                <li><a href="usuario-login.php">Login</a></LI><?php   
                }else{?> 
                <li><?= $_SESSION["nome_usuario"] ?></li><?php
                }?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="destaque">
            <h2>Bem-vindo à Wiki Oficial</h2>
            <p>Esta é a fonte oficial e definitiva de informações sobre o jogo Shadows Of The Sins.</p>
        </section>

        <section class="ultimas-atualizacoes">
            <h2>Últimas Atualizações</h2>
            <article>
                <h3>Patch 1.2 - Novos Itens</h3>
                <p>Foram adicionados os seguintes 5 novos itens ao jogo na ultima atualização: </p>
                <p>Gume do Infinito</p>
                <p>Canhão Fumegante</p>
                <p>Arco de Axioma</p>
                <p>Presa da Serpente</p>
                <p>Espada Ciclovoltaica</p>

            </article>
        </section>
    </main>

    <footer>
        <p>Creators [Filipe Almeida, João Lucas, Guilherme Colpani, Lucas Henrique e Igor Antoni] - © 2025</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>