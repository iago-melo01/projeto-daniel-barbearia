<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST["id"];
        $user = $_POST["user"];
        $cliente = $_POST["cliente"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $idade = $_POST["idade"];
        $telefone = $_POST["telefone"];

        // se a senha foi preenchida, atualiza ela tambem
        if(!empty($senha)) {
            $sql = "UPDATE usuarios SET 
                    user = '$user',
                    cliente = '$cliente',
                    email = '$email',
                    senha = '$senha',
                    idade = '$idade',
                    telefone = '$telefone'
                    WHERE id = '$id'";
        } else {
            //se nao, mantem a senha atual
            $sql = "UPDATE usuarios SET 
                    user = '$user',
                    cliente = '$cliente',
                    email = '$email',
                    idade = '$idade',
                    telefone = '$telefone'
                    WHERE id = '$id'";
        }

        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            echo "<h2>Cliente alterado com sucesso!</h2>";
            echo "<a href='?query=admin/cliente/listar-cadastros'>Ver todos</a> | ";
            echo "<a href='?query=admin/cliente/painel-admin-cliente'>Voltar ao Painel</a>";
        } else {
            echo "<h2>Erro ao alterar cliente.</h2>";
            echo "<a href='?query=admin/cliente/cliente-form-editar&id=$id'>Tentar novamente</a>";
        }
    } else {
        echo "<h2>Acesso negado.</h2>";
        echo "<a href='?query=admin/cliente/painel-admin-cliente'>Voltar</a>";
    }
?>

