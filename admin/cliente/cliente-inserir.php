<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cliente = $_POST["cliente"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $telefone = $_POST["telefone"];

        $sql = "INSERT INTO usuarios (cliente, email, senha, telefone) 
                VALUES ('$cliente', '$email', '$senha', '$telefone')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Cliente cadastrado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/cliente/cadastro-cliente', 'text' => 'Cadastrar outro'],
                ['url' => '?query=admin/cliente/listar-cadastros', 'text' => 'Ver todos'],
                ['url' => '?query=admin/cliente/painel-admin-cliente', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao cadastrar cliente.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/cliente/cadastro-cliente', 'text' => 'Tentar novamente']
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
