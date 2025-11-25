<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>

<h1>Barbeiros Cadastrados</h1>
<a href="?query=admin/barbeiro/cadastro-barbeiro">Cadastrar Novo Barbeiro</a> | 
<a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
<hr>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
<?php
    $sql = "SELECT * FROM barbeiros";
    $resultado = mysqli_query($connect, $sql);

    if(mysqli_num_rows($resultado) > 0) {
        while($dados = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $dados['id'] . "</td>";
            echo "<td>" . $dados['nome'] . "</td>";
            echo "<td>" . $dados['descricao'] . "</td>";
            echo "<td>
                    <a href='?query=admin/barbeiro/barbeiro-form-editar&id=" . $dados['id'] . "'>Editar</a> |
                    <a href='?query=admin/barbeiro/barbeiro-excluir&id=" . $dados['id'] . "'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum barbeiro cadastrado.</td></tr>";
    }
?>
    </tbody>
</table>

