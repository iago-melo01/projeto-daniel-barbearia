<h2>Cadastro de Barbeiro</h2>
<form action="?query=admin/barbeiro/barbeiro-inserir" method="post">
    <label>Nome do Barbeiro:</label><br>
    <input type="text" name="nome" required><br><br>
    
    <label>Descrição / Especialidade:</label><br>
    <textarea name="descricao" rows="4" cols="50" required></textarea><br><br>
    
    <input type="submit" value="Cadastrar Barbeiro"><br><br>
    <a href="?query=admin/barbeiro/listar-barbeiro">Ver Barbeiros Cadastrados</a> | 
    <a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
</form>
