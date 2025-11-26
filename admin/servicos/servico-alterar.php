<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $servico = $_POST["servico"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $imagem = $_POST["imagem"];

        $sql = "UPDATE servicos SET 
                servico = '$servico',
                descricao = '$descricao',
                preco = '$preco',
                imagem = '$imagem'
                WHERE id = '$id'";

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Serviço alterado com sucesso!</h2>";
            echo "<a href='?query=admin/servicos/listar-servico'>Ver todos</a> | ";
            echo "<a href='?query=admin/servicos/painel-admin-servicos'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao alterar serviço.</h2>";
            echo "<a href='?query=admin/servicos/servico-form-editar&id=$id'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/servicos/painel-admin-servicos'>Voltar</a>";
    }
?>

