<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        $message = "Cliente excluído com sucesso!";
        $type = "success";
        $links = [
            ['url' => '?query=admin/cliente/listar-cadastros', 'text' => 'Voltar para lista'],
            ['url' => '?query=admin/cliente/painel-admin-cliente', 'text' => 'Voltar ao Painel']
        ];
    } else {
        $message = "Erro ao excluir cliente!";
        $type = "error";
        $links = [
            ['url' => '?query=admin/cliente/listar-cadastros', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
