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
            echo "<h2>Agendamento realizado com sucesso!</h2>";
            echo "<a href='?query=admin/agendamento/cadastro-agendamento'>Novo agendamento</a> | ";
            echo "<a href='?query=admin/agendamento/listar-agendamento'>Ver todos</a> | ";
            echo "<a href='?query=admin/agendamento/painel-admin-agendamento'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao realizar agendamento.</h2>";
            echo "<a href='?query=admin/agendamento/cadastro-agendamento'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/agendamento/painel-admin-agendamento'>Voltar</a>";
    }
?>
