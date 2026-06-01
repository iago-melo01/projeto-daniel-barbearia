<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Gerenciamento de Barbeiros');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Gerenciamento de Barbeiros', array (
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
                <span class="admin-card-icon">➕</span>
                <h3>Cadastrar Barbeiro</h3>
                <p>Adicione um novo barbeiro ao sistema</p>
                <a href="?query=admin/barbeiro/cadastro-barbeiro">Cadastrar</a>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">📋</span>
                <h3>Listar Barbeiros</h3>
                <p>Visualize e gerencie todos os barbeiros cadastrados</p>
                <a href="?query=admin/barbeiro/listar-barbeiro">Listar</a>
            </div>
        </div>
    </div>
<?php adminFooterNav('?query=admin/admin', 'Voltar ao painel principal'); ?>
<?php adminPageClose(); ?>
</body>
</html>
