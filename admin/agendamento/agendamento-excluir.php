<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM agendamento WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        echo "<h2>Agendamento excluído com sucesso!</h2>";
        echo "<a href='?query=admin/agendamento/listar-agendamento'>Voltar para lista</a> | ";
        echo "<a href='?query=admin/agendamento/painel-admin-agendamento'>Voltar ao Painel</a>";
    } else {
        echo "<h2>Erro ao excluir agendamento!</h2>";
        echo "<a href='?query=admin/agendamento/listar-agendamento'>Voltar</a>";
    }
?>

