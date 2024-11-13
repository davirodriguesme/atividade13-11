<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de tarefas</title>
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
        <h1 class="titulo">Bem vindo ao cadastro de tarefas</h1>

    <div class="nav-buttons">
        <a href="index.php">principal</a>
        <a href="cadastrousu.php">cadastrar usuarios</a>
        <a href="gerenciartarefas.php">Gerencidor de tarefas</a>
    </div>
    </header>
    <main>
    <div class="dados">
        <form action="" method="post">
            <!-- Campo Setor -->
            <label for="setor">Setor:</label><br>
            <input type="text" id="setor" name="setor" required><br><br>

            <!-- Campo Prioridade -->
            <label for="prioridade">Prioridade:</label><br>
            <select name="prioridade" id="prioridade" required>
                <option value="1">Baixa</option>
                <option value="2">Média</option>
                <option value="3">Alta</option>
            </select><br><br>

            <!-- Campo Descrição -->
            <label for="descricao">Descrição:</label><br>
            <input type="text" id="descricao" name="descricao" required><br><br>

            <!-- Campo Status -->
            <label for="status">Status:</label><br>
            <select name="status" id="status" required>
                <option value="1">Pendente</option>
                <option value="2">Em andamento</option>
                <option value="3">Finalizada</option>
            </select><br><br>

            <!-- Botão de Enviar -->
            <input type="submit" class="b1" name="acao" value="Cadastrar">
        </form>
    </div>
</main>


        <?php

include 'conexao.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $setor = $_POST['setor'] ?? ''; 
    $prioridade = $_POST['prioridade'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $status = $_POST['status'] ?? '';

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    
    $sql = "INSERT INTO tbl_tarefas (tar_setor, tar_prioridade, tar_descricao, tar_status) VALUES (?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);

// Corrigido: indicando os tipos dos parâmetros (s = string, i = inteiro)
$stmt->bind_param("siss", $setor, $prioridade, $descricao, $status);  // 's' para strings, 'i' para inteiros

if ($stmt->execute()) { 
    echo "<p>Tarefa cadastrada com sucesso</p>";
} else {
    echo "<p>Erro ao cadastrar tarefa: " . $stmt->error . "</p>";
}


    
    $stmt->close();
    $conexao->close();
}

?>
    </main>
</body>
       
</html>