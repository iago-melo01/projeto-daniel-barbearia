<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>

<h1>Cortes Cadastrados</h1>
<a href="?query=admin/cortes/cadastro-corte">Cadastrar Novo Corte</a> | 
<a href="?query=admin/cortes/painel-admin-cortes">Voltar ao Painel</a>
<hr>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Corte</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
<?php
    $sql = "SELECT * FROM cortes";
    $resultado = mysqli_query($connect, $sql);

    if(mysqli_num_rows($resultado) > 0) {
        while($dados = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $dados['id'] . "</td>";
            echo "<td>" . $dados['corte'] . "</td>";
            echo "<td>" . $dados['descricao'] . "</td>";
            echo "<td>R$ " . $dados['preco'] . "</td>";
            echo "<td>" . $dados['imagem'] . "</td>";
            echo "<td>
                    <a href='?query=admin/cortes/corte-form-editar&id=" . $dados['id'] . "'>Editar</a> |
                    <a href='?query=admin/cortes/corte-excluir&id=" . $dados['id'] . "'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nenhum corte cadastrado.</td></tr>";
    }
?>
    </tbody>
</table>

