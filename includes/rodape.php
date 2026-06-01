<?php
    require_once __DIR__ . '/barbearia-paladinos.php';
    require_once __DIR__ . '/site.php';
?>
<footer class="site-footer">
    <p class="footer-script">Desde 2017</p>
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars(NOME_BARBEARIA) ?>. Todos os direitos reservados.</p>
    <p style="margin-top: 10px;">
        <a href="<?= htmlspecialchars(INSTAGRAM_BARBEARIA) ?>" target="_blank" rel="noopener noreferrer">
            Instagram <?= htmlspecialchars(INSTAGRAM_USUARIO) ?>
        </a>
    </p>
</footer>
