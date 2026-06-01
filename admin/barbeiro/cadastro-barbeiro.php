<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Cadastro de Barbeiro');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Cadastro de Barbeiro', array (
  0 => 
  array (
    'url' => '?query=admin/barbeiro/painel-admin-barbeiro',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/barbeiro/barbeiro-inserir" method="post">
            <div class="form-group">
                <label for="nome">Nome do Barbeiro:</label>
                <input type="text" name="nome" id="nome" required placeholder="Digite o nome completo">
            </div>

            <div class="form-group">
                <label for="email_id">E-mail do Barbeiro:</label>
                <input type="email" name="email" id="email_id" placeholder="exemplo@email.com" required>
            </div>

            <div class="form-group">
                <label for="senha_id">Senha:</label>
                <input type="text" name="senha" id="senha_id" placeholder="Cadastre uma senha" required>
            </div>

            <div class="form-group">
                <label for="descricao_id">Descrição / Especialidade:</label>
                <textarea name="descricao" id="descricao_id" rows="4" placeholder="Descreva a especialidade do barbeiro..." required></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Cadastrar Barbeiro</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/barbeiro/listar-barbeiro">Ver Barbeiros Cadastrados</a>
            <a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
        </div>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
