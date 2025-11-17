<?php
    $sql = mysqli_connect("localhost","root","");
    $banco = mysqli_select_db($sql,"barbearia");

    if(!$sql){
        echo "<h2> Não foi possível conectar ao banco de dados. </h2>";
    }

?>