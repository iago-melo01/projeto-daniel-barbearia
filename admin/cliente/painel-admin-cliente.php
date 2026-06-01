<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Gerenciamento de Clientes');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Gerenciamento de Clientes', array (
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
                <h3>Cadastrar Cliente</h3>
                <p>Adicione um novo cliente ao sistema</p>
                <a href="?query=admin/cliente/cadastro-cliente">Cadastrar</a>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">📋</span>
                <h3>Listar Clientes</h3>
                <p>Visualize e gerencie todos os clientes cadastrados</p>
                <a href="?query=admin/cliente/listar-cadastros">Listar</a>
            </div>
        </div>
    </div>
<?php adminFooterNav('?query=admin/admin', 'Voltar ao painel principal'); ?>
<?php adminPageClose(); ?>
</body>
</html>
