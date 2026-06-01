<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $barbeiro = $_POST["barbeiro"];
        $servico = $_POST["servico"];
        $horario = $_POST["horario"];

        $sql = "INSERT INTO agendamento (barbeiro, servico, horario) 
                VALUES ('$barbeiro', '$servico', '$horario')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Agendamento realizado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/agendamento/cadastro-agendamento', 'text' => 'Novo agendamento'],
                ['url' => '?query=admin/agendamento/listar-agendamento', 'text' => 'Ver todos'],
                ['url' => '?query=admin/agendamento/painel-admin-agendamento', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao realizar agendamento.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/agendamento/cadastro-agendamento', 'text' => 'Tentar novamente']
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
