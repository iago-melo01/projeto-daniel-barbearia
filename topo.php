<?php
    require_once __DIR__ . '/includes/site.php';
    require_once __DIR__ . '/includes/barbearia-paladinos.php';
?>
<header class="site-header">
    <div class="header-container">
        <a href="?query=home" class="logo-link">
            <img
                src="<?= htmlspecialchars(urlAsset(LOGO_PALADINOS)) ?>"
                alt="<?= htmlspecialchars(defined('NOME_BARBEARIA') ? NOME_BARBEARIA : 'Barbearia Paladinos') ?>"
                class="logo-img"
            >
        </a>
        <nav class="nav-links" aria-label="Menu principal">
            <a href="?query=home">Início</a>
            <a href="?query=servicos">Serviços</a>
            <a href="?query=agendar">Agendar</a>
            <a href="?query=sobre">Sobre</a>
            <a href="?query=fale_conosco">Fale conosco</a>
            <a href="?query=login-barbeiro" class="btn-login">Área do Barbeiro</a>
        </nav>
    </div>
</header>
