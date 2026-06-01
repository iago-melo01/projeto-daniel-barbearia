<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM servicos WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        $message = "Serviço excluído com sucesso!";
        $type = "success";
        $links = [
            ['url' => '?query=admin/servicos/listar-servico', 'text' => 'Voltar para lista'],
            ['url' => '?query=admin/servicos/painel-admin-servicos', 'text' => 'Voltar ao Painel']
        ];
    } else {
        $message = "Erro ao excluir serviço!";
        $type = "error";
        $links = [
            ['url' => '?query=admin/servicos/listar-servico', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
