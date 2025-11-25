<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM agendamento WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $agendamento = mysqli_fetch_array($resultado);
        
        // Buscar barbeiros para o select
        $sqlBarbeiros = "SELECT * FROM barbeiros";
        $barbeiros = mysqli_query($connect, $sqlBarbeiros);
        
        // Buscar cortes para o select
        $sqlCortes = "SELECT * FROM cortes";
        $cortes = mysqli_query($connect, $sqlCortes);
?>

<h2>Editar Agendamento</h2>
<form action="?query=admin/agendamento/agendamento-alterar" method="post">
    <input type="hidden" name="id" value="<?=$agendamento['id']?>">
    
    <label>Barbeiro:</label><br>
    <select name="barbeiro" required>
        <option value="">Selecione um barbeiro</option>
        <?php
            if(mysqli_num_rows($barbeiros) > 0) {
                while($b = mysqli_fetch_array($barbeiros)) {
                    $selected = ($b['id'] == $agendamento['barbeiro']) ? 'selected' : '';
                    echo "<option value='" . $b['id'] . "' $selected>" . $b['nome'] . "</option>";
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
                    $selected = ($c['corte'] == $agendamento['corte']) ? 'selected' : '';
                    echo "<option value='" . $c['corte'] . "' $selected>" . $c['corte'] . " - R$ " . $c['preco'] . "</option>";
                }
            }
        ?>
    </select><br><br>
    
    <label>Data e Horário:</label><br>
    <input type="datetime-local" name="horario" value="<?=date('Y-m-d\TH:i', strtotime($agendamento['horario']))?>" required><br><br>
    
    <input type="submit" value="Salvar Alterações"><br><br>
    <a href="?query=admin/agendamento/listar-agendamento">Cancelar</a> | 
    <a href="?query=admin/agendamento/painel-admin-agendamento">Voltar ao Painel</a>
</form>

<?php
    } else {
        echo "<h2>Agendamento não encontrado!</h2>";
        echo "<a href='?query=admin/agendamento/listar-agendamento'>Voltar para lista</a>";
    }
?>

