<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
    <style>
         header {
            background-color: #4CAF50; /* Cor de fundo verde */
            color: white; /* Texto branco */
            padding: 10px;
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

        .title{
            color: white;
        }
    </style>
</head>
<body>
    </header>
    <h2 class="title">Bem vindo a pagina principal</h2>
    <div class="nav-buttons">
        <a href="cadastrousu.php">Usuario</a>
        <a href="cadastrartarefas.php">cadastrar tarefas</a>
        <a href="gerenciartarefas.php">Gerencidor de tarefas</a>
    </div>
    <header>

    
</body>
</html>