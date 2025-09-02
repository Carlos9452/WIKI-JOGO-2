<?php
require "conexao.php";

// Inicializar variáveis para evitar erros
$dados = [
    'nome' => '',
    'cpf' => '',
    'data_nascimento' => '',
    'celular' => '',
    'email' => '',
    'idade' => '',
    'Cidade' => '',
    'Estado' => ''
];

if (isset($_GET["idLogin"])) {
    $idLogin = $_GET["idLogin"];
    $sql = "SELECT * FROM Login WHERE idLogin = ?";
    $consulta = $mysqli->prepare($sql);
    $consulta->bind_param("i", $idLogin); // Corrigido: era $idUsuario
    $consulta->execute();
    $resultado = $consulta->get_result();
    
    if ($resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();
    }
}

// Processar o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Salvar'])) {
    // Aqui você deve adicionar a lógica para atualizar os dados no banco
    $idLogin = $_GET["idLogin"];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento']; // Corrigido: era data_nasc
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $Cidade = $_POST['Cidade'];
    $Estado = $_POST['Estado'];
    
    // Exemplo de query de atualização (ajuste conforme sua estrutura de tabela)
    $sql_update = "UPDATE Login SET nome=?, cpf=?, data_nascimento=?, celular=?, email=?, idade=?, Cidade=?, Estado=? WHERE idLogin=?";
    $stmt = $mysqli->prepare($sql_update);
    $stmt->bind_param("ssssssssi", $nome, $cpf, $data_nascimento, $celular, $email, $idade, $Cidade, $Estado, $idLogin);
    
    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!');</script>";
        // Recarregar os dados atualizados
        $consulta->execute();
        $resultado = $consulta->get_result();
        $dados = $resultado->fetch_assoc();
    } else {
        echo "<script>alert('Erro ao atualizar dados: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Painel Administrativo</title>
    <style>
        :root {
            --bg-primary: #121212;
            --bg-secondary: #1e1e1e;
            --bg-tertiary: #2d2d2d;
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --accent-color: #4a76d0;
            --accent-hover: #5a86e0;
            --border-color: #333;
            --success-color: #28a745;
            --danger-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: var(--bg-secondary);
            padding: 20px 0;
            border-right: 1px solid var(--border-color);
        }

        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .sidebar-header h2 {
            color: var(--text-primary);
            font-size: 1.5rem;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            border-left: 4px solid var(--accent-color);
        }

        .menu-item i {
            margin-right: 10px;
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .header h1 {
            font-size: 1.8rem;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .card {
            background-color: var(--bg-secondary);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h2 {
            font-size: 1.3rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-secondary);
        }

        .form-control {
            width: 100%;
            padding: 10px;
            background-color: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            color: var(--text-primary);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--accent-color);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .theme-selector {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .theme-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .theme-option.active {
            border-color: var(--text-primary);
        }

        .theme-dark {
            background-color: #121212;
        }

        .theme-darker {
            background-color: #0a0a0a;
        }

        .theme-blue {
            background-color: #1a237e;
        }

        .theme-green {
            background-color: #1b5e20;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar/Menu -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Pagina Configuação</h2>
            </div>
            <a href="#" class="menu-item active">
                <i>⚙️</i> Configurações
            </a>
            <a href="#" class="menu-item">
                <i>👥</i> Usuários
            </a>
        </div>

        <!-- Conteúdo Principal -->
        <div class="main-content">
            <div class="header">
                <h1>Configurações do Sistema</h1>
                <div class="user-info">
                    <div class="user-avatar">A</div>
                </div>
            </div>

            <div class="card">
            <h1>Edita do usuário</h1>
  <form method="post" action="./Configuação.php">
    <table border="1" align="center">
<tr>
    <th>Nome:</th>
    <td>
    <input type="text" name="nome" size="40"
    value="<?= $dados['nome'] ?>">    
    </td>
</tr>
<tr>
    <th>Cpf:</th>
    <td>
        <input type="text" name="cpf"
        value="<?= $dados['cpf'] ?>">
    </td>
</tr>
<tr>
    <th>data de nascimento:</th>
    <td>
    <input type="date" name="data_nasc"
    value="<?= $dados['data_nascimento'] ?>">
    </td>
</tr>
<tr>
    <th>Celular:</th>
    <td>
    <input type="text" name="celular"
    value="<?= $dados['celular'] ?>">
    </td>
</tr>
<tr>
    <th>email:</th>
    <td>
    <input type="text" name="email" size="20"
    value="<?= $dados['email'] ?>">
    </td>
</tr>
<tr>
    <th>Idade:</th>
    <td>
    <input type="text" name="idade"
    value="<?= $dados['idade'] ?>">
    </td>
</tr>
<tr>
    <th colspan="2">endereco</th>
</tr>
<tr>
    <th>Cidade:</th>
    <td>
    <input type="text" name="Cidade"
    value="<?= $dados['Cidade'] ?>">
    </td>
</tr>
<th>Estado:</th>
 <td>
 <select name="Estado">
    <option value="AC" <?= $dados['Estado'] == 'AC' ? 'selected' : '' ?>>Acre</option>
     <option value="AL" <?= $dados['Estado'] == 'AL' ? 'selected' : '' ?>>Alagoas</option>
      <option value="AP" <?= $dados['Estado'] == 'AP' ? 'selected' : '' ?>>Amapá</option>
       <option value="AM" <?= $dados['Estado'] == 'AM' ? 'selected' : '' ?>>Amazonas</option>
        <option value="BA" <?= $dados['Estado'] == 'BA' ? 'selected' : '' ?>>Bahia</option>
         <option value="CE" <?= $dados['Estado'] == 'CE' ? 'selected' : '' ?>>Ceará</option>
          <option value="DF" <?= $dados['Estado'] == 'DF' ? 'selected' : '' ?>>Distrito Federal</option>
           <option value="ES" <?= $dados['Estado'] == 'ES' ? 'selected' : '' ?>>Espírito Santo</option>
            <option value="GO" <?= $dados['Estado'] == 'GO' ? 'selected' : '' ?>>Goiás</option>
             <option value="MA" <?= $dados['Estado'] == 'MA' ? 'selected' : '' ?>>Maranhão</option>
              <option value="MT" <?= $dados['Estado'] == 'MT' ? 'selected' : '' ?>>Mato Grosso</option>
               <option value="MS" <?= $dados['Estado'] == 'MS' ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                <option value="MG" <?= $dados['Estado'] == 'MG' ? 'selected' : '' ?>>Minas Gerais</option>
                 <option value="PA" <?= $dados['Estado'] == 'PA' ? 'selected' : '' ?>>Pará</option>
                  <option value="PB" <?= $dados['Estado'] == 'PB' ? 'selected' : '' ?>>Paraíba</option>
                 <option value="PR" <?= $dados['Estado'] == 'PR' ? 'selected' : '' ?>>Paraná</option>
                <option value="PE" <?= $dados['Estado'] == 'PE' ? 'selected' : '' ?>>Pernambuco</option>
               <option value="PI" <?= $dados['Estado'] == 'PI' ? 'selected' : '' ?>>Piauí</option>
              <option value="RJ" <?= $dados['Estado'] == 'RJ' ? 'selected' : '' ?>>Rio de Janeiro</option>
             <option value="RN" <?= $dados['Estado'] == 'RN' ? 'selected' : '' ?>>Rio Grande do Norte</option>
            <option value="RS" <?= $dados['Estado'] == 'RS' ? 'selected' : '' ?>>Rio Grande do Sul</option>
           <option value="RO" <?= $dados['Estado'] == 'RO' ? 'selected' : '' ?>>Rondônia</option>
          <option value="RR" <?= $dados['Estado'] == 'RR' ? 'selected' : '' ?>>Roraima</option>
         <option value="SC" <?= $dados['Estado'] == 'SC' ? 'selected' : '' ?>>Santa Catarina</option>
        <option value="SP" <?= $dados['Estado'] == 'SP' ? 'selected' : '' ?>>São Paulo</option>
       <option value="SE" <?= $dados['Estado'] == 'SE' ? 'selected' : '' ?>>Sergipe</option>
      <option value="TO" <?= $dados['Estado'] == 'TO' ? 'selected' : '' ?>>Tocantins</option>
</select> 
</td>
</tr>
<tr>
    <td colspan="2" align="center">
       <input type="submit" value="Salvar Modificação" name="Salvar">
    </td>
</tr>
</h1>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Ações</h2>
                </div>
                <button class="btn btn-primary">Salvar Configurações</button>
                <button class="btn btn-danger" style="margin-left: 10px;">Restaurar Padrões</button>
            </div>
        </div>
    </div>
</body>
</html>