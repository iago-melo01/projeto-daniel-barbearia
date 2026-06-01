<?php
    require_once("admin/conectaMYSQL.php");
    require_once __DIR__ . '/includes/barbearia-paladinos.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - <?= htmlspecialchars(NOME_BARBEARIA) ?></title>
    <?php include_once __DIR__ . '/includes/layout-head.php'; ?>
</head>
<body>
    <?php include_once 'topo.php'; ?>

    <section class="pal-hero">
        <p class="hero-script">Barbearia</p>
        <h1>Paladinos</h1>
        <p>Tradição, estilo e excelência em cada detalhe</p>
    </section>

    <div class="page-container">
        <h2 class="section-title">Quem Somos</h2>
        <div class="pal-card sobre-texto">
            <p>
                A <strong>Barbearia Paladinos</strong> nasceu com um propósito simples: oferecer muito mais do que um corte de cabelo.
                Criamos um espaço onde tradição e modernidade se unem para proporcionar uma experiência única, confortável e inesquecível.
            </p>
            <p>
                Cada cliente é atendido com atenção, respeito e profissionalismo. Valorizamos o estilo individual de cada pessoa, e
                buscamos sempre entregar o melhor resultado — seja em cortes clássicos, modernos, barba ou design de sobrancelha.
            </p>
            <p>
                Com profissionais experientes, ambiente acolhedor e produtos de alta qualidade, nossa missão é garantir que você
                saia renovado, confiante e com a autoestima lá em cima.
            </p>
            <p><strong>Mais do que uma barbearia, somos um estilo de vida.</strong></p>
        </div>
    </div>

    <?php include_once __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>
