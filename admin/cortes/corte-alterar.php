<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $corte = $_POST["corte"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $imagem = $_POST["imagem"];

        $sql = "UPDATE cortes SET 
                corte = '$corte',
                descricao = '$descricao',
                preco = '$preco',
                imagem = '$imagem'
                WHERE id = '$id'";

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Corte alterado com sucesso!</h2>";
            echo "<a href='?query=admin/cortes/listar-corte'>Ver todos</a> | ";
            echo "<a href='?query=admin/cortes/painel-admin-cortes'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao alterar corte.</h2>";
            echo "<a href='?query=admin/cortes/corte-form-editar&id=$id'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/cortes/painel-admin-cortes'>Voltar</a>";
    }
?>

