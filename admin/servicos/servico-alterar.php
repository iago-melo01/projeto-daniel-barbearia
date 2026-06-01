<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $servico = $_POST["servico"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $imagem = $_POST["imagem"];

        $sql = "UPDATE servicos SET 
                servico = '$servico',
                descricao = '$descricao',
                preco = '$preco',
                imagem = '$imagem'
                WHERE id = '$id'";

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Serviço alterado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/servicos/listar-servico', 'text' => 'Ver todos'],
                ['url' => '?query=admin/servicos/painel-admin-servicos', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao alterar serviço.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/servicos/servico-form-editar&id=' . $id, 'text' => 'Tentar novamente']
            ];
        }
    } else {
        $message = "Acesso negado.";
        $type = "error";
        $links = [
            ['url' => '?query=admin/servicos/painel-admin-servicos', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
