<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Gerenciamento de Agendamentos');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Gerenciamento de Agendamentos', array (
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
                <h3>Novo Agendamento</h3>
                <p>Crie um novo agendamento no sistema</p>
                <a href="?query=admin/agendamento/cadastro-agendamento">Criar Agendamento</a>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">📋</span>
                <h3>Listar Agendamentos</h3>
                <p>Visualize e gerencie todos os agendamentos</p>
                <a href="?query=admin/agendamento/listar-agendamento">Listar</a>
            </div>
        </div>
    </div>
<?php adminFooterNav('?query=admin/admin', 'Voltar ao painel principal'); ?>
<?php adminPageClose(); ?>
</body>
</html>
