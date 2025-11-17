<?php
    $connect = mysqli_connect("localhost","root","");
    $banco = mysqli_select_db($connect,"barbearia");

    if(!$connect){
        echo "<h2> Não foi possível conectar ao banco de dados. </h2>";
    }

?>