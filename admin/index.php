<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador</title>
</head>
<body>
    <header>
        <h2> Painel Administrador da Barbearia </h2>
        <a href="?query=cadastra-barbeiro">Cadastro de Barbeiros</a>
        <a href="?query=login-cliente">Login de usuário</a>
        <a href="?query=agendamento">Horários Disponíveis</a>
    </header>
    <master>
        <?php
            if(empty($_SERVER['QUERY_STRING'])){
                $query = 'login';
                include_once("$query.php");
            }
            else{
                $query = $_GET['query'];
                include_once("$query.php");
            }
        ?>
    </master>
</body>
</html>