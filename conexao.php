<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_tarefas";

// Cria a conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error); // Correção do ponto e vírgula
} else {
    echo "Conectado com sucesso";
}

?>