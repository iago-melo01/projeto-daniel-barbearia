<?php
    require_once __DIR__ . '/../conectaMYSQL.php';
    require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';

    $id = (int) ($_GET['id'] ?? 0);
    if ($id < 1) {
        die('ID inválido');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resposta = mysqli_real_escape_string($connect, $_POST['resposta'] ?? '');
        $sql = "UPDATE fale_conosco 
                SET resposta = '$resposta', status = 'respondido', data_resposta = NOW()
                WHERE id = $id";
        mysqli_query($connect, $sql);
        $salvo = true;
    }

    mysqli_query($connect, "UPDATE fale_conosco SET status = 'lido' WHERE id = $id");

    $sql = "SELECT * FROM fale_conosco WHERE id = $id";
    $res = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_assoc($res);

    if (!$dados) {
        die('Mensagem não encontrada');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php adminHead('Visualizar mensagem'); ?>
</head>
<body class="admin-body">
    <?php
        adminTopBar('Visualizar mensagem', [
            ['url' => '?query=admin/faleconosco/listar', 'label' => 'Voltar à lista', 'class' => 'admin-btn-secondary'],
        ]);
        adminPageOpen('narrow');
    ?>

    <?php if (!empty($salvo)): ?>
        <div class="alert alert-success">Resposta salva com sucesso.</div>
    <?php endif; ?>

    <div class="admin-detail-box">
        <p><strong>Nome:</strong> <?= htmlspecialchars($dados['nome']) ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($dados['email']) ?></p>
        <p><strong>Telefone:</strong> <?= htmlspecialchars($dados['telefone']) ?></p>
        <p><strong>Assunto:</strong> <?= htmlspecialchars($dados['assunto']) ?></p>
        <p><strong>Mensagem:</strong><br><?= nl2br(htmlspecialchars($dados['mensagem'])) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($dados['status']) ?></p>
    </div>

    <div class="form-container" style="margin-top: 24px;">
        <form method="POST">
            <div class="form-group">
                <label for="resposta"><strong>Responder ao cliente</strong></label>
                <textarea name="resposta" id="resposta" rows="6" required><?= htmlspecialchars($dados['resposta'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn-submit">Salvar resposta</button>
        </form>
    </div>

    <?php adminPageClose(); ?>
</body>
</html>
