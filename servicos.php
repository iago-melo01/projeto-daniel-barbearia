<?php
    require_once("admin/conectaMYSQL.php");
    require_once __DIR__ . '/includes/barbearia-paladinos.php';
    $catalogoServicos = obterCatalogoServicosPaladinos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - <?= htmlspecialchars(NOME_BARBEARIA) ?></title>
    <?php include_once __DIR__ . '/includes/layout-head.php'; ?>
</head>
<body>
    <?php include_once 'topo.php'; ?>
    <div class="page-container">
        <h2 class="section-title">Todos os Nossos Serviços</h2>
        <div class="services-grid">
            <?php
                $sql = "SELECT * FROM servicos";
                $resultado = mysqli_query($connect, $sql);
                $exibidos = 0;

                if (mysqli_num_rows($resultado) > 0) {
                    while ($servico = mysqli_fetch_array($resultado)) {
                        $nome = $servico['servico'];
                        if (!isset($catalogoServicos[$nome])) {
                            continue;
                        }
                        $exibidos++;
                        $info = $catalogoServicos[$nome];
                        echo '<div class="service-card">';
                        echo '<img src="' . htmlspecialchars($servico['imagem']) . '" alt="' . htmlspecialchars($nome) . '" class="service-image">';
                        echo '<h3>' . htmlspecialchars($nome) . '</h3>';
                        echo '<p>' . htmlspecialchars($servico['descricao']) . '</p>';
                        echo '<p style="padding:0 20px;color:var(--pal-texto-suave);font-size:0.9rem;">Duração: ' . (int) $info['duracao'] . ' min</p>';
                        echo '<div class="service-price">R$ ' . number_format($info['preco'], 2, ',', '.') . '</div>';
                        echo '<a href="?query=agendar" class="btn-agendar">Agendar Este Serviço</a>';
                        echo '</div>';
                    }
                }

                if ($exibidos === 0) {
                    echo '<p style="grid-column:1/-1;text-align:center;color:var(--pal-texto-suave);padding:40px;">Nenhum serviço disponível no momento.</p>';
                }
            ?>
        </div>
    </div>
    <?php include_once __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>
