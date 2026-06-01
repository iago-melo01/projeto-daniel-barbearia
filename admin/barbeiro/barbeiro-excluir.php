<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM barbeiros WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        $message = "Barbeiro excluído com sucesso!";
        $type = "success";
        $links = [
            ['url' => '?query=admin/barbeiro/listar-barbeiro', 'text' => 'Voltar para lista'],
            ['url' => '?query=admin/barbeiro/painel-admin-barbeiro', 'text' => 'Voltar ao Painel']
        ];
    } else {
        $message = "Erro ao excluir barbeiro!";
        $type = "error";
        $links = [
            ['url' => '?query=admin/barbeiro/listar-barbeiro', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
