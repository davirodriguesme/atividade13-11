<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuario</title>
    <style>
        header {
            background-color: #4CAF50; /* Cor de fundo verde */
            color: white; /* Texto branco */
            padding: 15px;
            text-align: center;
        }

        /* Estilo dos botões no cabeçalho */
        header .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        /* Estilo dos links como botões */
        .nav-buttons a {
            background-color: #aff5a4; /* Fundo branco para o botão */
            color: white; /* Texto verde */
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        /* Efeito ao passar o mouse */
        .nav-buttons a:hover {
            background-color: #4CAF50 ; /* Fundo cinza claro */
        }
        
        body{
            background-color: #bcdeb6;
        }

        .titulo{
            color: white;
            padding: 2px;
        }

        .dados{
            text-align: center;
        }

      
    </style>
</head>

<body>
    <header>
        <h1 class="titulo">Bem vindo ao cadastro de usuario</h1>

    <div class="nav-buttons">
        <a href="index.php">principal</a>
        <a href="cadastrartarefas.php">cadastrar tarefas</a>
        <a href="gerenciartarefas.php">Gerencidor de tarefas</a>
    </div>
    </header>

    <main>
    <div class="dados">
            <form action="" method="post">
            <label for="nome">Nome:</label>
            <br>
            <input type="text" id="nome"
            name="nome" required><br>
            <br>
            <label for="email">Email:</label>
            <br>
            <input type="email" id="email"
            name="email" required><br><br>

            <input type="submit" class="b1" name="acao" value="Cadastrar">
    </div>
        </form>

        <?php

// Inclusão do arquivo de conexão com o banco de dados
include 'conexao.php'; // Certifique-se de que o caminho para o arquivo está correto

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados enviados pelo formulário
    $nome = $_POST['nome'] ?? ''; // Recebe o nome enviado pelo formulário
    $email = $_POST['email'] ?? ''; // Recebe o email enviado pelo formulário

    // Verifica se a conexão com o banco foi bem-sucedida
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Prepara e executa a inserção dos dados no banco de dados
    $sql = "INSERT INTO tbl_usuarios (usu_nome, usu_email) VALUES (?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $nome, $email);

    if ($stmt->execute()) {
        echo "<p>Usuário '$nome' cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar usuário: " . $stmt->error . "</p>";
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
}

?>
    </main>
</body>
       
</html>