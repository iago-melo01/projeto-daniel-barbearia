<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $cliente = $_POST["cliente"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $telefone = $_POST["telefone"];

        // se a senha foi preenchida, atualiza ela tambem
        if(!empty($senha)) {
            $sql = "UPDATE usuarios SET 
                    cliente = '$cliente',
                    email = '$email',
                    senha = '$senha',
                    telefone = '$telefone'
                    WHERE id = '$id'";
        } else {
            //se nao, mantem a senha atual
            $sql = "UPDATE usuarios SET 
                    cliente = '$cliente',
                    email = '$email',
                    telefone = '$telefone'
                    WHERE id = '$id'";
        }

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Cliente alterado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/cliente/listar-cadastros', 'text' => 'Ver todos'],
                ['url' => '?query=admin/cliente/painel-admin-cliente', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao alterar cliente.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/cliente/cliente-form-editar&id=' . $id, 'text' => 'Tentar novamente']
            ];
        }
    } else {
        $message = "Acesso negado.";
        $type = "error";
        $links = [
            ['url' => '?query=admin/cliente/painel-admin-cliente', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
