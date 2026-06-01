<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];
        $email = $_POST["email"];
        $descricao = $_POST["descricao"];

        $sql = "INSERT INTO barbeiros (nome, senha, email, descricao) VALUES ('$nome', '$senha', '$email', '$descricao')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Barbeiro cadastrado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/barbeiro/cadastro-barbeiro', 'text' => 'Cadastrar outro'],
                ['url' => '?query=admin/barbeiro/listar-barbeiro', 'text' => 'Ver todos'],
                ['url' => '?query=admin/barbeiro/painel-admin-barbeiro', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao cadastrar barbeiro.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/barbeiro/cadastro-barbeiro', 'text' => 'Tentar novamente']
            ];
        }
    } else {
        $message = "Acesso negado.";
        $type = "error";
        $links = [
            ['url' => '?query=admin/barbeiro/cadastro-barbeiro', 'text' => 'Voltar']
        ];
    }


require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminPaginaMensagem($message, $type, $links);
