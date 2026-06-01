<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];
        $email = $_POST["email"];
        $descricao = $_POST["descricao"];

        $sql = "UPDATE barbeiros SET 
                nome = '$nome',
                senha = '$senha',
                email = '$email',
                descricao = '$descricao'
                WHERE id = '$id'";

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Barbeiro alterado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/barbeiro/listar-barbeiro', 'text' => 'Ver todos'],
                ['url' => '?query=admin/barbeiro/painel-admin-barbeiro', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao alterar barbeiro.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/barbeiro/barbeiro-form-editar&id=' . $id, 'text' => 'Tentar novamente']
            ];
        }
    } else {
        $message = "Acesso negado.";
        $type = "error";
        $links = [
            ['url' => '?query=admin/barbeiro/painel-admin-barbeiro', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
