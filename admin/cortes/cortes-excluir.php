<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    $id = $_GET['id'];

    $sql = "DELETE FROM cortes WHERE id= $id";

    $resultado = mysqli_query($connect, $sql);
    if($resultado){
        echo "<h2>Página excluída com sucesso!</h2>";
        echo "<a href='?query=admin/cortes/paginas'>Listar Página</a>";
    }else{
        echo "<h2>Erro ao excluir página!</h2>";
        echo "<br><a href='?query=admin/cortes/paginas'>Voltar</a>";
    }