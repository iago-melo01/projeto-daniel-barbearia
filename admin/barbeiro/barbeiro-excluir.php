<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM barbeiros WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        echo "<h2>Barbeiro excluído com sucesso!</h2>";
        echo "<a href='?query=admin/barbeiro/listar-barbeiro'>Voltar para lista</a> | ";
        echo "<a href='?query=admin/barbeiro/painel-admin-barbeiro'>Voltar ao Painel</a>";
    } else {
        echo "<h2>Erro ao excluir barbeiro!</h2>";
        echo "<a href='?query=admin/barbeiro/listar-barbeiro'>Voltar</a>";
    }
?>

