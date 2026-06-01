<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $barbeiro = $_POST["barbeiro"];
        $servico = $_POST["servico"];
        $horario = $_POST["horario"];

        $sql = "UPDATE agendamento SET 
                barbeiro = '$barbeiro',
                servico = '$servico',
                horario = '$horario'
                WHERE id = '$id'";

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Agendamento alterado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/agendamento/listar-agendamento', 'text' => 'Ver todos'],
                ['url' => '?query=admin/agendamento/painel-admin-agendamento', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao alterar agendamento.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/agendamento/agendamento-form-editar&id=' . $id, 'text' => 'Tentar novamente']
            ];
        }
    } else {
        $message = "Acesso negado.";
        $type = "error";
        $links = [
            ['url' => '?query=admin/agendamento/painel-admin-agendamento', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
