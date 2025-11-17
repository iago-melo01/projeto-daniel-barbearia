<?php
    include_once('../conectaMYSQL.php');

    $sql = "SELECT * FROM agendamento";

    $tabela = mysqli_query($connect,$sql);
    echo "<h1> Todos os Agendamentos  </h1>";
    if(mysqli_num_rows($tabela) > 0){
        while(!empty($dados = mysqli_fetch_array($tabela))){
            echo "Barbeiro: ". $dados['barbeiro'] . "<br>";
            echo "Corte Escolhido: ". $dados['corte'] . "<br>";
            echo "Horário: ". $dados['horario'] . "<br>";
            echo "<hr></hr>";
        }
    }
    else{
        echo "<h2> Não foi possível mostrar os dados da tabela </h2>";
    }


?>