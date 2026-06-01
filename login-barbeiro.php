<?php
    require_once("admin/conectaMYSQL.php");
    require_once __DIR__ . '/includes/barbearia-paladinos.php';
    require_once __DIR__ . '/includes/site.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?= htmlspecialchars(NOME_BARBEARIA) ?></title>
    <?php include_once __DIR__ . '/includes/layout-head.php'; ?>
</head>
<body class="login-page">
    <div class="login-box">
        <img
            src="<?= htmlspecialchars(urlAsset(LOGO_PALADINOS)) ?>"
            alt="<?= htmlspecialchars(NOME_BARBEARIA) ?>"
            class="logo-login"
        >
        <h1>Área do Barbeiro</h1>
        <p class="login-script">Acesso restrito</p>
        <p style="text-align:center;margin-bottom:20px;">
            <span class="barbeiro-badge">Barbeiro</span>
        </p>

        <form action="?query=admin/admin" method="POST">
            <div class="form-group">
                <label for="email">E-mail profissional</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="seu.email@barbearia.com"
                    required
                    autocomplete="email"
                >
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required
                    autocomplete="current-password"
                >
            </div>
            <button type="submit" class="btn-submit">Entrar no Painel</button>
        </form>

        <p class="login-footer-link">
            <a href="?query=home">← Voltar para página inicial</a>
        </p>
    </div>
</body>
</html>
