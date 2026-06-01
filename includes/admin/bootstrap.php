<?php
    if (!defined('PROJECT_ROOT')) {
        define('PROJECT_ROOT', dirname(__DIR__, 2));
    }

    require_once PROJECT_ROOT . '/includes/site.php';
    require_once PROJECT_ROOT . '/includes/barbearia-paladinos.php';

    function adminHead(string $titulo): void
    {
        $tituloCompleto = htmlspecialchars($titulo) . ' — Admin | ' . htmlspecialchars(NOME_BARBEARIA);
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#000000">
        <meta name="color-scheme" content="dark">
        <title><?= $tituloCompleto ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&family=UnifrakturMaguntia&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= htmlspecialchars(urlAsset('assets/css/paladinos-theme.css')) ?>">
        <link rel="stylesheet" href="<?= htmlspecialchars(urlAsset('assets/css/admin-paladinos.css')) ?>">
        <?php
    }

    /**
     * @param array<int, array{url: string, label: string, class?: string}> $acoes
     */
    function adminTopBar(string $titulo, array $acoes = [], ?string $subtitulo = null): void
    {
        ?>
        <header class="admin-topbar">
            <div class="admin-topbar-inner">
                <div class="admin-topbar-brand">
                    <a href="?query=admin/admin" class="admin-logo-link">
                        <img src="<?= htmlspecialchars(urlAsset(LOGO_PALADINOS)) ?>" alt="<?= htmlspecialchars(NOME_BARBEARIA) ?>" class="admin-logo-img">
                    </a>
                    <div class="admin-topbar-titles">
                        <h1 class="admin-topbar-title"><?= htmlspecialchars($titulo) ?></h1>
                        <?php if ($subtitulo): ?>
                            <p class="admin-topbar-sub"><?= htmlspecialchars($subtitulo) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($acoes)): ?>
                    <nav class="admin-topbar-actions">
                        <?php foreach ($acoes as $acao): ?>
                            <a href="<?= htmlspecialchars($acao['url']) ?>" class="admin-btn <?= htmlspecialchars($acao['class'] ?? 'admin-btn-secondary') ?>">
                                <?= htmlspecialchars($acao['label']) ?>
                            </a>
                        <?php endforeach; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </header>
        <?php
    }

    function adminPageOpen(string $largura = 'wide'): void
    {
        $classe = $largura === 'narrow' ? 'admin-main admin-main--narrow' : 'admin-main';
        echo '<main class="' . $classe . '">';
    }

    function adminPageClose(): void
    {
        echo '</main>';
    }

    function adminFooterNav(string $voltarUrl, string $voltarLabel = 'Voltar'): void
    {
        ?>
        <div class="admin-footer-nav">
            <a href="<?= htmlspecialchars($voltarUrl) ?>" class="admin-btn admin-btn-secondary"><?= htmlspecialchars($voltarLabel) ?></a>
            <a href="?query=admin/logout" class="admin-btn admin-btn-outline">Sair do painel</a>
        </div>
        <?php
    }

    /**
     * @param array<int, array{url: string, text: string}> $links
     */
    function adminPaginaMensagem(string $mensagem, string $tipo, array $links): void
    {
        $icone = $tipo === 'success' ? '✓' : '✕';
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <?php adminHead($tipo === 'success' ? 'Sucesso' : 'Aviso'); ?>
        </head>
        <body class="admin-body admin-body--centered">
            <div class="admin-message-box admin-message-box--<?= htmlspecialchars($tipo) ?>">
                <div class="admin-message-icon"><?= $icone ?></div>
                <h2><?= htmlspecialchars($mensagem) ?></h2>
                <div class="admin-message-links">
                    <?php foreach ($links as $link): ?>
                        <a href="<?= htmlspecialchars($link['url']) ?>" class="admin-btn admin-btn-primary"><?= htmlspecialchars($link['text']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    function adminAcessoNegado(string $mensagem, string $urlLogin = '?query=login-barbeiro', string $botao = 'Ir para Login'): void
    {
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <?php adminHead('Acesso negado'); ?>
        </head>
        <body class="admin-body admin-body--centered">
            <div class="admin-message-box admin-message-box--error">
                <div class="admin-message-icon">🔒</div>
                <h2>Acesso negado</h2>
                <p><?= htmlspecialchars($mensagem) ?></p>
                <div class="admin-message-links">
                    <a href="<?= htmlspecialchars($urlLogin) ?>" class="admin-btn admin-btn-primary"><?= htmlspecialchars($botao) ?></a>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
