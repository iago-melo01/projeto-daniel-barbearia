<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Fale Conosco');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Fale Conosco', array (
  0 => 
  array (
    'url' => '?query=admin/admin',
    'label' => 'Painel principal',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen();
?>

    <div class="admin-container">
        <div class="admin-grid">

            <div class="admin-card">
                <span class="admin-card-icon">📩</span>
                <h3>Mensagens Recebidas</h3>
                <p>Visualize todas as mensagens enviadas pelo Fale Conosco</p>
                <a href="?query=admin/faleconosco/listar">Ver Mensagens</a>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">💬</span>
                <h3>Responder Mensagens</h3>
                <p>Acesse rapidamente mensagens pendentes de resposta</p>
                <a href="?query=admin/faleconosco/listar&filter=novo">Mensagens Pendentes</a>
            </div>

        </div>
    </div>
<?php adminFooterNav('?query=admin/admin', 'Voltar ao painel principal'); ?>
<?php adminPageClose(); ?>
</body>

