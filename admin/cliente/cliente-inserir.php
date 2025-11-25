<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST["user"];
        $cliente = $_POST["cliente"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $idade = $_POST["idade"];
        $telefone = $_POST["telefone"];

        $sql = "INSERT INTO usuarios (user, cliente, email, senha, idade, telefone) 
                VALUES ('$user', '$cliente', '$email', '$senha', '$idade', '$telefone')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Cliente cadastrado com sucesso!</h2>";
            echo "<a href='?query=admin/cliente/cadastro-cliente'>Cadastrar outro</a> | ";
            echo "<a href='?query=admin/cliente/listar-cadastros'>Ver todos</a> | ";
            echo "<a href='?query=admin/cliente/painel-admin-cliente'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao cadastrar cliente.</h2>";
            echo "<a href='?query=admin/cliente/cadastro-cliente'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/cliente/painel-admin-cliente'>Voltar</a>";
    }
?>

