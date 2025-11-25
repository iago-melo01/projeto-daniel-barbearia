<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $barbeiro = $_POST["barbeiro"];
        $corte = $_POST["corte"];
        $horario = $_POST["horario"];

        $sql = "UPDATE agendamento SET 
                barbeiro = '$barbeiro',
                corte = '$corte',
                horario = '$horario'
                WHERE id = '$id'";

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Agendamento alterado com sucesso!</h2>";
            echo "<a href='?query=admin/agendamento/listar-agendamento'>Ver todos</a> | ";
            echo "<a href='?query=admin/agendamento/painel-admin-agendamento'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao alterar agendamento.</h2>";
            echo "<a href='?query=admin/agendamento/agendamento-form-editar&id=$id'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/agendamento/painel-admin-agendamento'>Voltar</a>";
    }
?>

