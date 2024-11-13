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

<!-- O resto do HTML do seu código -->


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

        .treeview ul {
            list-style-type: none;
            padding-left: 20px;
        }

        .treeview li {
            cursor: pointer;
            margin: 5px 0;
        }

        .treeview li .nested {
            display: none;
        }

        .treeview li .caret::before {
            content: "\25B6";
            color: #4CAF50;
            display: inline-block;
            margin-right: 6px;
        }

        .treeview li .caret-down::before {
            transform: rotate(90deg);
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
    </style>
</head>

<body>
    <header>
        <h1 class="titulo">Bem-vindo ao gerenciador de tarefas</h1>

        <div class="nav-buttons">
            <a href="index.php">Principal</a>
            <a href="cadastrousu.php">Cadastrar usuários</a>
            <a href="cadastrartarefas.php">Cadastro de tarefas</a>
            <a href="treview.php">Teste</a>
        </div>
    </header>

    <input type="submit" class="b1" name="acao" value="Editar">
    <input type="submit" class="b1" name="acao" value="Excluir">
    <input type="submit" class="b1" name="acao" value="Alterar status">

    <div class="treeview">
        <h2 class="titulo">Lista de Tarefas</h2>
        <ul id="tarefaTree">
            <?php
            if ($query) {
                $setorAtual = null;
                while ($row = $query->fetch_assoc()) {
                    // Se o setor mudar, inicia um novo item de setor no TreeView
                    if ($setorAtual !== $row['tar_setor']) {
                        if ($setorAtual !== null) {
                            echo '</ul></li>'; // Fechando o setor anterior
                        }
                        echo '<li><span class="caret">' . htmlspecialchars($row['tar_setor']) . '</span>';
                        echo '<ul class="nested">';
                        $setorAtual = $row['tar_setor']; // Atualizando o setor atual
                    }

                    // Adiciona cada tarefa dentro do setor
                    echo '<li><span class="caret">' . htmlspecialchars($row['tar_descricao']) . '</span>';
                    echo '<ul class="nested">';
                    echo '<li>Prioridade: ' . htmlspecialchars($row['tar_prioridade']) . '</li>';
                    echo '<li>Status: ' . htmlspecialchars($row['tar_status']) . '</li>';
                    echo '</ul></li>';
                }
                echo '</ul></li>'; // Fechando o último setor
            } else {
                echo "<li>Erro ao carregar as tarefas: " . $conn->error . "</li>";
            }
            ?>
        </ul>
    </div>

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
