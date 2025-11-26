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
        
        // Buscar servicos para o select
        $sqlServicos = "SELECT * FROM servicos";
        $servicos = mysqli_query($connect, $sqlServicos);
?>

<h2>Editar Agendamento</h2>
<form action="?query=admin/agendamento/agendamento-alterar" method="post">
    <input type="hidden" name="id" value="<?=$agendamento['id']?>">
    
    <label>Barbeiro:</label><br>
    <select name="barbeiro" required>
        <option value="">Selecione um barbeiro</option>
        <?php
            if(mysqli_num_rows($barbeiros) > 0) {
                while($barbeiro = mysqli_fetch_array($barbeiros)) {
                    $selected = ($barbeiro['id'] == $agendamento['barbeiro']) ? 'selected' : '';
                    echo "<option value='" . $barbeiro['id'] . "' $selected>" . $barbeiro['nome'] . "</option>";
                }
            }
        ?>
    </select><br><br>
    
    <label>Serviço:</label><br>
    <select name="servico" required>
        <option value="">Selecione um serviço</option>
        <?php
            if(mysqli_num_rows($servicos) > 0) {
                while($s = mysqli_fetch_array($servicos)) {
                    $selected = ($servico['servico'] == $agendamento['servico']) ? 'selected' : '';
                    echo "<option value='" . $servico['servico'] . "' $selected>" . $servico['servico'] . " - R$ " . $servico['preco'] . "</option>";
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
