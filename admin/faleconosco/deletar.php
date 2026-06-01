<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM fale_conosco WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        $message = "Mensagem excluída com sucesso!";
        $type = "success";
        $links = [
            ['url' => '?query=admin/faleconosco/listar', 'text' => 'Voltar para lista'],
            ['url' => '?query=admin/faleconosco/painel-admin-faleconosco', 'text' => 'Voltar ao Painel']
        ];
    } else {
        $message = "Erro ao excluir mensagem!";
        $type = "error";
        $links = [
            ['url' => '?query=admin/faleconosco/listar', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
