<?php

require_once(__DIR__ . "/../conectaMYSQL.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST["corte"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $imagem = $_POST["imagem"];
    $id = $_POST["id"];

    $sql = "UPDATE cortes SET 
            corte = '$corte',
            descricao = '$descricao',
            preco = '$preco',
            imagem = '$imagem'
            WHERE id = '$id'";

    $executa = mysqli_query($connect, $sql);
    if($executa) {
        echo "<h2>Alteração realizada com sucesso.</h2>";
        echo "<a href='?query=admin/cortes/paginas'>Voltar</a>";
    }else{
        echo "<h2>Erro ao alterar página.</h2>";
        echo "<a href='?query=admin/cortes/paginas'>Voltar</a>";
    }
}else{
    echo "<h2>Acesso negado.</h2>";
    echo "<a href='?query=admin/cortes/paginas'>Voltar</a>";
}



