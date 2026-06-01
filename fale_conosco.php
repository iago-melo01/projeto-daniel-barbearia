<?php
require_once("admin/conectaMYSQL.php");
require_once __DIR__ . '/includes/barbearia-paladinos.php';

$mensagem_envio = '';
$tipoMensagem_envio = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO fale_conosco (nome, email, telefone, assunto, mensagem) 
            VALUES ('$nome','$email','$telefone','$assunto','$mensagem')";

    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {
        $mensagem_envio = 'Mensagem enviada com sucesso!';
        $tipoMensagem_envio = 'success';
    } else {
        $mensagem_envio = 'Erro ao enviar mensagem. Tente novamente.';
        $tipoMensagem_envio = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale conosco - <?= htmlspecialchars(NOME_BARBEARIA) ?></title>
    <?php include_once __DIR__ . '/includes/layout-head.php'; ?>
</head>
<body>
    <?php include_once 'topo.php'; ?>

    <div class="page-container--narrow">
        <div class="pal-card">
            <h2 class="form-page-title">Enviar Mensagem</h2>

            <?php if ($mensagem_envio): ?>
                <div class="alert alert-<?= htmlspecialchars($tipoMensagem_envio) ?>">
                    <?= htmlspecialchars($mensagem_envio) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="nome">Seu Nome Completo</label>
                    <input type="text" id="nome" name="nome" required placeholder="Digite seu nome">
                </div>
                <div class="form-group">
                    <label for="email">Seu E-mail</label>
                    <input type="email" id="email" name="email" required placeholder="seu.email@exemplo.com">
                </div>
                <div class="form-group">
                    <label for="telefone">Seu Telefone</label>
                    <input type="text" id="telefone" name="telefone" required placeholder="83999999999" maxlength="15">
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <textarea id="assunto" name="assunto" required placeholder="Assunto"></textarea>
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" required placeholder="Mensagem"></textarea>
                </div>
                <button type="submit" class="btn-submit">Enviar Mensagem</button>
            </form>
        </div>
    </div>

    <?php include_once __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>
