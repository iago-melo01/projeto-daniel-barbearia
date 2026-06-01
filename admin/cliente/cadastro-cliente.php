<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Cadastro de Cliente');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Cadastro de Cliente', array (
  0 => 
  array (
    'url' => '?query=admin/cliente/painel-admin-cliente',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/cliente/cliente-inserir" method="post">
            <div class="form-group">
                <label for="cliente">Nome Completo:</label>
                <input type="text" name="cliente" id="cliente" required placeholder="Digite o nome completo">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="exemplo@email.com" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Cadastre uma senha" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" placeholder="(00) 00000-0000" required>
            </div>
            
            <button type="submit" class="btn-submit">Cadastrar Cliente</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/cliente/listar-cadastros">Ver Clientes Cadastrados</a>
            <a href="?query=admin/cliente/painel-admin-cliente">Voltar ao Painel</a>
        </div>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
