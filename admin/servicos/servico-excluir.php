<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM servicos WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        echo "<h2>Serviço excluído com sucesso!</h2>";
        echo "<a href='?query=admin/servicos/listar-servico'>Voltar para lista</a> | ";
        echo "<a href='?query=admin/servicos/painel-admin-servicos'>Voltar ao Painel</a>";
    } else {
        echo "<h2>Erro ao excluir serviço!</h2>";
        echo "<a href='?query=admin/servicos/listar-servico'>Voltar</a>";
    }
?>

