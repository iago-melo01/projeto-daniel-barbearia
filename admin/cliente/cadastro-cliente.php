<h2>Cadastro de Cliente</h2>
<form action="?query=admin/cliente/cliente-inserir" method="post">
    <label>Nome de Usuário:</label><br>
    <input type="text" name="user" required><br><br>
    
    <label>Nome Completo:</label><br>
    <input type="text" name="cliente" required><br><br>
    
    <label>E-mail:</label><br>
    <input type="email" name="email" required><br><br>
    
    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>
    
    <label>Idade:</label><br>
    <input type="number" name="idade" required><br><br>
    
    <label>Telefone:</label><br>
    <input type="text" name="telefone" required><br><br>
    
    <input type="submit" value="Cadastrar Cliente"><br><br>
    <a href="?query=admin/cliente/listar-cadastros">Ver Clientes Cadastrados</a> | 
    <a href="?query=admin/cliente/painel-admin-cliente">Voltar ao Painel</a>
</form>

