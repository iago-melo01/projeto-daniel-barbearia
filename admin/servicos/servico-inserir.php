<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servico = $_POST["servico"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $imagem = $_POST["imagem"];

        $sql = "INSERT INTO servicos (servico, descricao, preco, imagem) 
                VALUES ('$servico', '$descricao', '$preco', '$imagem')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Serviço cadastrado com sucesso!</h2>";
            echo "<a href='?query=admin/servicos/cadastro-servico'>Cadastrar outro</a> | ";
            echo "<a href='?query=admin/servicos/listar-servico'>Ver todos</a> | ";
            echo "<a href='?query=admin/servicos/painel-admin-servicos'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao cadastrar serviço.</h2>";
            echo "<a href='?query=admin/servicos/cadastro-servico'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/servicos/painel-admin-servicos'>Voltar</a>";
    }
?>

