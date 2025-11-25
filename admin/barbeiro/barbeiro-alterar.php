<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];

        $sql = "UPDATE barbeiros SET 
                nome = '$nome',
                descricao = '$descricao'
                WHERE id = '$id'";

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Barbeiro alterado com sucesso!</h2>";
            echo "<a href='?query=admin/barbeiro/listar-barbeiro'>Ver todos</a> | ";
            echo "<a href='?query=admin/barbeiro/painel-admin-barbeiro'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao alterar barbeiro.</h2>";
            echo "<a href='?query=admin/barbeiro/barbeiro-form-editar&id=$id'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/barbeiro/painel-admin-barbeiro'>Voltar</a>";
    }
?>

