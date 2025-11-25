<h2>Cadastro de Corte</h2>
<form action="?query=admin/cortes/corte-inserir" method="post">
    <label>Nome do Corte:</label><br>
    <input type="text" name="corte" required><br><br>
    
    <label>Descrição:</label><br>
    <textarea name="descricao" rows="4" cols="50" required></textarea><br><br>
    
    <label>Preço (R$):</label><br>
    <input type="number" name="preco" required><br><br>
    
    <label>Imagem (URL):</label><br>
    <input type="text" name="imagem"><br><br>
    
    <input type="submit" value="Cadastrar Corte"><br><br>
    <a href="?query=admin/cortes/listar-corte">Ver Cortes Cadastrados</a> | 
    <a href="?query=admin/cortes/painel-admin-cortes">Voltar ao Painel</a>
</form>

