<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Cadastro de Serviço');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Cadastro de Serviço', array (
  0 => 
  array (
    'url' => '?query=admin/servicos/painel-admin-servicos',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/servicos/servico-inserir" method="post">
            <div class="form-group">
                <label for="servico">Nome do Serviço:</label>
                <input type="text" name="servico" id="servico" required placeholder="Ex: Corte Masculino">
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" required placeholder="Descreva o serviço oferecido..."></textarea>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço (R$):</label>
                <input type="number" name="preco" id="preco" step="0.01" min="0" required placeholder="0.00">
            </div>
            
            <div class="form-group">
                <label for="imagem">Imagem (URL):</label>
                <input type="text" name="imagem" id="imagem" placeholder="https://exemplo.com/imagem.jpg">
            </div>
            
            <button type="submit" class="btn-submit">Cadastrar Serviço</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/servicos/listar-servico">Ver Serviços Cadastrados</a>
            <a href="?query=admin/servicos/painel-admin-servicos">Voltar ao Painel</a>
        </div>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
