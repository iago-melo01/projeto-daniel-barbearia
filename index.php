<?php
    if(empty($_SERVER['QUERY_STRING'])){
        $query = 'conteudo';
        include_once("$query.php");
    }
    else{
        $query = $_GET['query'];
            include_once("$query.php");
    }
?>