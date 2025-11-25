<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM cortes WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        echo "<h2>Corte excluído com sucesso!</h2>";
        echo "<a href='?query=admin/cortes/listar-corte'>Voltar para lista</a> | ";
        echo "<a href='?query=admin/cortes/painel-admin-cortes'>Voltar ao Painel</a>";
    } else {
        echo "<h2>Erro ao excluir corte!</h2>";
        echo "<a href='?query=admin/cortes/listar-corte'>Voltar</a>";
    }
?>

