<?php
    include_once ('../conectaMYSQL.php');
?>

    <form method="POST">
        <input type="number" min="1" max="10 "name="barbeiro-id" placeholder="Número do Barbeiro">
        <input type="text" name="corte" placeholder="Corte desejado">
        <input type="datetime-local" name="horario">

        <button type="submit">Marcar Agendamento</button>

    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $barbeiro = $_POST['barbeiro-id'];
        $corte = $_POST['corte'];
        $horario = $_POST['horario'];

        $sql = "INSERT INTO agendamento(barbeiro,corte,horario) VALUES ('$barbeiro','$corte','$horario')";

        $inserir = mysqli_query($connect,$sql);

        if($inserir){
            echo "<h2> Agendamento concluído com sucesso!! </h2> ";
        }
    }
    ?>