<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    // Buscar barbeiros para o select
    $sqlBarbeiros = "SELECT * FROM barbeiros";
    $barbeiros = mysqli_query($connect, $sqlBarbeiros);
    
    // Buscar cortes para o select
    $sqlCortes = "SELECT * FROM cortes";
    $cortes = mysqli_query($connect, $sqlCortes);
?>

<h2>Novo Agendamento</h2>
<form action="?query=admin/agendamento/agendamento-inserir" method="post">
    <label>Barbeiro:</label><br>
    <select name="barbeiro" required>
        <option value="">Selecione um barbeiro</option>
        <?php
            if(mysqli_num_rows($barbeiros) > 0) {
                while($b = mysqli_fetch_array($barbeiros)) {
                    echo "<option value='" . $b['id'] . "'>" . $b['nome'] . "</option>";
                }
            }
        ?>
    </select><br><br>
    
    <label>Corte:</label><br>
    <select name="corte" required>
        <option value="">Selecione um corte</option>
        <?php
            if(mysqli_num_rows($cortes) > 0) {
                while($c = mysqli_fetch_array($cortes)) {
                    echo "<option value='" . $c['corte'] . "'>" . $c['corte'] . " - R$ " . $c['preco'] . "</option>";
                }
            }
        ?>
    </select><br><br>
    
    <label>Data e Horário:</label><br>
    <input type="datetime-local" name="horario" required><br><br>
    
    <input type="submit" value="Marcar Agendamento"><br><br>
    <a href="?query=admin/agendamento/listar-agendamento">Ver Agendamentos</a> | 
    <a href="?query=admin/agendamento/painel-admin-agendamento">Voltar ao Painel</a>
</form>
