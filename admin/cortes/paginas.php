<table class="table table-striped">
    <thead>
    <tr>
        <th>Corte |</th>
        <th>Descrição |</th>
        <th>Preço |</th>
        <th>Opções</th>
    </tr>
    </thead>
    <tbody>
<?php
    require_once "../conectaMYSQL.php";

    echo "<br><br><a href='?pg=cortes-form'>Criar página</a>";

    echo "<h1>Lista de páginas</h1>";

    $sql = "SELECT * FROM cortes";
    $resultado = mysqli_query($connect, $sql);

    if(mysqli_num_rows($resultado) > 0){
        while($dados = mysqli_fetch_array($resultado)){
            echo "<tr>";
            echo "<td>" . $dados['corte'] . "</td>";
            echo "<td>" . $dados['descricao'] .  "</td>";
            echo "<td>" . $dados['preco'] .  "</td>";
            echo "<td>
                    <a href='?pg=cortes-form-alterar&id=" . $dados['id'] . "'>Editar</a> |
                    <a href='?pg=cortes-excluir&id=" . $dados['id'] . "'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    }else{
        echo "<h3>Nenhuma página criada!</h3>";
    }
?>


