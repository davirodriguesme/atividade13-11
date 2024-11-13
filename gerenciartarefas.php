<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de tarefas</title>
    <style>
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .nav-buttons a {
            background-color: #aff5a4;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .nav-buttons a:hover {
            background-color: #4CAF50;
        }

        body {
            background-color: #bcdeb6;
        }

        .titulo {
            color: white;
            padding: 2px;
        }


        input[type="submit"].b1 {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 13px;
            font-size: 11px;
        }

        input[type="submit"].b1:hover {
            background-color: #218838;
        }

        .cod {
            padding: -7px -4px
            

        }
    </style>
</head>

<body>
    <header>
        <h1 class="titulo">gerenciador de tarefas</h1>

        <div class="nav-buttons">
            <a href="index.php">Principal</a>
            <a href="cadastrousu.php">Cadastrar usuários</a>
            <a href="cadastrartarefas.php">Cadastro de tarefas</a>
        </div>
    </header>


    <form method="POST" action="">
    <input type="submit" class="b1" name="acao" value="Alterar status">
    <input type="submit" class="b1" name="acao" value="Alterar">
    <input type="submit" class="b1" name="acao" value="Excluir">
    <input type="submit" class="b1" name="acao" value="Salvar">
    <input type="text" class="cod" id="Codigo" name="Codigo" required placeholder="Código da tarefa">
    
    <!-- Campos para editar a prioridade e a descrição -->
    <textarea name="tar_descricao" id="tar_descricao" placeholder="Nova descrição" required></textarea>
    
    <select name="tar_prioridade" id="tar_prioridade" required>
        <option value="facil">Fácil</option>
        <option value="media">Média</option>
        <option value="dificil">Difícil</option>
    </select>
    
    <select name="status" id="status" required>
        <option value="pendente">Pendente</option>
        <option value="em andamento">Em andamento</option>
        <option value="finalizada">Finalizada</option>
    </select>
    
</form>



<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php'; // Certifique-se de incluir a conexão corretamente

// Consulta as tarefas no banco de dados
$query = $conexao->query("SELECT tar_setor, tar_prioridade, tar_descricao, tar_status FROM tbl_tarefas");

if ($query) {
    // Loop através de cada linha de resultado
    while ($row = $query->fetch_assoc()) {
        echo '<li><span class="caret">' . htmlspecialchars($row['tar_setor']) . '</span>';
        echo '<ul class="nested">';
        echo '<li>Descrição: ' . htmlspecialchars($row['tar_descricao']) . '</li>';
        echo '<li>Prioridade: ' . htmlspecialchars($row['tar_prioridade']) . '</li>';
        echo '<li>Status: ' . htmlspecialchars($row['tar_status']) . '</li>';
        echo '</ul></li>';
    }
} else {
    echo "Erro na consulta: " . $conexao->error;
}
?>

<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'Codigo' foi enviado
    if (isset($_POST['Codigo'])) {
        // Pega o código da tarefa do campo de texto
        $codigo = $_POST['Codigo'];

        // Ação Alterar
        if (isset($_POST['acao']) && $_POST['acao'] === 'Alterar') {
            // Consulta para pegar os dados da tarefa com base no código
            $query = $conexao->query("SELECT * FROM tbl_tarefas WHERE tar_codigo = '$codigo'");
            
            if ($query->num_rows > 0) {
                // Exibe os dados atuais para alteração
                $tarefa = $query->fetch_assoc();
                echo "<form method='POST' action=''>
                        <input type='text' name='tar_descricao' value='" . htmlspecialchars($tarefa['tar_descricao']) . "' required>
                        <select name='tar_prioridade' required>
                            <option value='facil' " . ($tarefa['tar_prioridade'] == 'facil' ? 'selected' : '') . ">Fácil</option>
                            <option value='media' " . ($tarefa['tar_prioridade'] == 'media' ? 'selected' : '') . ">Média</option>
                            <option value='dificil' " . ($tarefa['tar_prioridade'] == 'dificil' ? 'selected' : '') . ">Difícil</option>
                        </select>
                        <input type='submit' name='acao' value='Salvar'>
                      </form>";
            } else {
                echo "Tarefa não encontrada!";
            }
        }

        // Ação Salvar (alterar descrição e prioridade)
        if (isset($_POST['acao']) && $_POST['acao'] === 'Salvar') {
            // Pega os novos dados do formulário
            $descricao = $_POST['tar_descricao'];
            $prioridade = $_POST['tar_prioridade'];

            // Atualiza a tarefa no banco de dados
            $conexao->query("UPDATE tbl_tarefas SET tar_descricao = '$descricao', tar_prioridade = '$prioridade' WHERE tar_codigo = '$codigo'");

            echo "Tarefa alterada com sucesso!";
        }

        // Ação Excluir
        if (isset($_POST['acao']) && $_POST['acao'] === 'Excluir') {
            // Exclui a tarefa com base no código
            $conexao->query("DELETE FROM tbl_tarefas WHERE tar_codigo = '$codigo'");
            echo "Tarefa excluída com sucesso!";
        }

        // Ação Alterar status
        if (isset($_POST['acao']) && $_POST['acao'] === 'Alterar status') {
            // Pega o status da tarefa
            $status = $_POST['status'];

            // Atualiza o status da tarefa no banco de dados
            $conexao->query("UPDATE tbl_tarefas SET tar_status = '$status' WHERE tar_codigo = '$codigo'");
            echo "Status da tarefa alterado para '$status'.";
        }
    } else {
        echo "Por favor, insira o código da tarefa.";
    }
}
?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggler = document.getElementsByClassName("caret");
            for (var i = 0; i < toggler.length; i++) {
                toggler[i].addEventListener("click", function() {
                    this.parentElement.querySelector(".nested").classList.toggle("active");
                    this.classList.toggle("caret-down");
                });
            }
        });
    </script>


</body>
</html>