<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM agendamento WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        $message = "Agendamento excluído com sucesso!";
        $type = "success";
        $links = [
            ['url' => '?query=admin/agendamento/listar-agendamento', 'text' => 'Voltar para lista'],
            ['url' => '?query=admin/agendamento/painel-admin-agendamento', 'text' => 'Voltar ao Painel']
        ];
    } else {
        $message = "Erro ao excluir agendamento!";
        $type = "error";
        $links = [
            ['url' => '?query=admin/agendamento/listar-agendamento', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
