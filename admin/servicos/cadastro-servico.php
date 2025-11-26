<h2>Cadastro de Serviço</h2>
<form action="?query=admin/servicos/servico-inserir" method="post">
    <label>Nome do Serviço:</label><br>
    <input type="text" name="servico" required><br><br>
    
    <label>Descrição:</label><br>
    <textarea name="descricao" rows="4" cols="50" required></textarea><br><br>
    
    <label>Preço (R$):</label><br>
    <input type="number" name="preco" required><br><br>
    
    <label>Imagem (URL):</label><br>
    <input type="text" name="imagem"><br><br>
    
    <input type="submit" value="Cadastrar Serviço"><br><br>
    <a href="?query=admin/servicos/listar-servico">Ver Serviços Cadastrados</a> | 
    <a href="?query=admin/servicos/painel-admin-servicos">Voltar ao Painel</a>
</form>

