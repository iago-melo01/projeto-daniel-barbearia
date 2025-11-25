<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $corte = $_POST["corte"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $imagem = $_POST["imagem"];

        $sql = "INSERT INTO cortes (corte, descricao, preco, imagem) 
                VALUES ('$corte', '$descricao', '$preco', '$imagem')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Corte cadastrado com sucesso!</h2>";
            echo "<a href='?query=admin/cortes/cadastro-corte'>Cadastrar outro</a> | ";
            echo "<a href='?query=admin/cortes/listar-corte'>Ver todos</a> | ";
            echo "<a href='?query=admin/cortes/painel-admin-cortes'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao cadastrar corte.</h2>";
            echo "<a href='?query=admin/cortes/cadastro-corte'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/cortes/painel-admin-cortes'>Voltar</a>";
    }
?>

