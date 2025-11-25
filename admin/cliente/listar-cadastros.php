<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>

<h1>Clientes Cadastrados</h1>
<a href="?query=admin/cliente/cadastro-cliente">Cadastrar Novo Cliente</a> | 
<a href="?query=admin/cliente/painel-admin-cliente">Voltar ao Painel</a>
<hr>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Idade</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
<?php
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($connect, $sql);

    if(mysqli_num_rows($resultado) > 0) {
        while($dados = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $dados['id'] . "</td>";
            echo "<td>" . $dados['user'] . "</td>";
            echo "<td>" . $dados['cliente'] . "</td>";
            echo "<td>" . $dados['email'] . "</td>";
            echo "<td>" . $dados['idade'] . "</td>";
            echo "<td>" . $dados['telefone'] . "</td>";
            echo "<td>
                    <a href='?query=admin/cliente/cliente-form-editar&id=" . $dados['id'] . "'>Editar</a> |
                    <a href='?query=admin/cliente/cliente-excluir&id=" . $dados['id'] . "'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Nenhum cliente cadastrado.</td></tr>";
    }
?>
    </tbody>
</table>
