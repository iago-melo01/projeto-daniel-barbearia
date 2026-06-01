<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servico = $_POST["servico"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $imagem = $_POST["imagem"];

        $sql = "INSERT INTO servicos (servico, descricao, preco, imagem) 
                VALUES ('$servico', '$descricao', '$preco', '$imagem')";
        
        $executa = mysqli_query($connect, $sql);
        
        if($executa) {
            $message = "Serviço cadastrado com sucesso!";
            $type = "success";
            $links = [
                ['url' => '?query=admin/servicos/cadastro-servico', 'text' => 'Cadastrar outro'],
                ['url' => '?query=admin/servicos/listar-servico', 'text' => 'Ver todos'],
                ['url' => '?query=admin/servicos/painel-admin-servicos', 'text' => 'Voltar ao Painel']
            ];
        } else {
            $message = "Erro ao cadastrar serviço.";
            $type = "error";
            $links = [
                ['url' => '?query=admin/servicos/cadastro-servico', 'text' => 'Tentar novamente']
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
