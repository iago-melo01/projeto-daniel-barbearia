<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Gerenciamento de Serviços');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Gerenciamento de Serviços', array (
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
                <h3>Cadastrar Serviço</h3>
                <p>Adicione um novo serviço ao catálogo</p>
                <a href="?query=admin/servicos/cadastro-servico">Cadastrar</a>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">📋</span>
                <h3>Listar Serviços</h3>
                <p>Visualize e gerencie todos os serviços cadastrados</p>
                <a href="?query=admin/servicos/listar-servico">Listar</a>
            </div>
        </div>
    </div>
<?php adminFooterNav('?query=admin/admin', 'Voltar ao painel principal'); ?>
<?php adminPageClose(); ?>
</body>
</html>
