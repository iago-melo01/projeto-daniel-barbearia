<h2>Cadastro de Barbeiro</h2>
<form action="?query=admin/barbeiro/barbeiro-inserir" method="post">
    <label>Nome do Barbeiro:</label><br>
    <input type="text" name="nome" required><br><br>

    <label for="email_id">E-mail do barbeiro:</label><br>
    <input type="email" name="email" id="email_id" placeholder="Digite seu e-mail"><br><br>

    <label for="senha_id">Senha:</label><br>
    <input type="text" name="senha" id="senha_id" placeholder="Cadastre uma senha"><br><br>

    <label for="descricao_id">Descrição / Especialidade:</label><br>
    <textarea name="descricao" rows="4" cols="50"  id="descricao_id"required></textarea><br><br>
    
    <input type="submit" value="Cadastrar Barbeiro"><br><br>
    <a href="?query=admin/barbeiro/listar-barbeiro">Ver Barbeiros Cadastrados</a> | 
    <a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
</form>
