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
    require_once(__DIR__ . "/../conectaMYSQL.php");

    echo "<h1>Lista de páginas</h1>";

    echo "<h2><a href='?query=admin/admin'>Voltar</a><br></h2>";

    $sql = "SELECT * FROM cortes";
    $resultado = mysqli_query($connect, $sql);

    if(mysqli_num_rows($resultado) > 0){
        while($dados = mysqli_fetch_array($resultado)){
            echo "<tr>";
            echo "<td>" . $dados['corte'] . "</td>";
            echo "<td>" . $dados['descricao'] .  "</td>";
            echo "<td>" . $dados['preco'] .  "</td>";
            echo "<td>
                    <a href='?query=admin/cortes/cortes-form&id=" . $dados['id'] . "'>Criar</a> |
                    <a href='?query=admin/cortes/cortes-form-alterar&id=" . $dados['id'] . "'>Editar</a> |
                    <a href='?query=admin/cortes/cortes-excluir&id=" . $dados['id'] . "'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    }else{
        echo "<h3>Nenhuma página criada!</h3>";
        echo "<a href='?query=admin/cortes/cortes-form'>Criar página</a><br><br>";
    }
    
?>





