<?php
    $sql = "SELECT * FROM usuarios ";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        while($dados = mysqli_fetch_array($resultado))
    {
        echo "Id do Cliente: $dados[id]";
        echo "Nome: " . $dados['cliente'];
        echo "Idade: " . $dados['idade'];
        echo "Número de telefone: " . $dados['telefone'];
        echo "<hr></hr>";
    }
    }else{
        echo "<br><h2>Nenhum cliente encontrado!</h2><br>";
    }
?>