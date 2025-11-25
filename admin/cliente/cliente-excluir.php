<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        echo "<h2>Cliente excluído com sucesso!</h2>";
        echo "<a href='?query=admin/cliente/listar-cadastros'>Voltar para lista</a> | ";
        echo "<a href='?query=admin/cliente/painel-admin-cliente'>Voltar ao Painel</a>";
    } else {
        echo "<h2>Erro ao excluir cliente!</h2>";
        echo "<a href='?query=admin/cliente/listar-cadastros'>Voltar</a>";
    }
?>

