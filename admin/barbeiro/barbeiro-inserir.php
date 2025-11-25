<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];

        $sql = "INSERT INTO barbeiros (nome, descricao) VALUES ('$nome', '$descricao')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Barbeiro cadastrado com sucesso!</h2>";
            echo "<a href='?query=admin/barbeiro/cadastro-barbeiro'>Cadastrar outro</a> | ";
            echo "<a href='?query=admin/barbeiro/listar-barbeiro'>Ver todos</a> | ";
            echo "<a href='?query=admin/barbeiro/painel-admin-barbeiro'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao cadastrar barbeiro.</h2>";
            echo "<a href='?query=admin/barbeiro/cadastro-barbeiro'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/barbeiro/cadastro-barbeiro'>Voltar</a>";
    }
?>

