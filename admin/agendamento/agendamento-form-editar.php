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
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Editar Agendamento');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Editar Agendamento', array (
  0 => 
  array (
    'url' => '?query=admin/agendamento/listar-agendamento',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/agendamento/agendamento-alterar" method="post">
            <input type="hidden" name="id" value="<?=$agendamento['id']?>">
            
            <div class="form-group">
                <label for="barbeiro">Barbeiro:</label>
                <select name="barbeiro" id="barbeiro" required>
                    <option value="">Selecione um barbeiro</option>
                    <?php
                        if(mysqli_num_rows($barbeiros) > 0) {
                            while($barbeiro = mysqli_fetch_array($barbeiros)) {
                                $selected = ($barbeiro['id'] == $agendamento['barbeiro']) ? 'selected' : '';
                                echo "<option value='" . $barbeiro['id'] . "' $selected>" . htmlspecialchars($barbeiro['nome']) . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="servico">Serviço:</label>
                <select name="servico" id="servico" required>
                    <option value="">Selecione um serviço</option>
                    <?php
                        if(mysqli_num_rows($servicos) > 0) {
                            while($s = mysqli_fetch_array($servicos)) {
                                $selected = ($s['servico'] == $agendamento['servico']) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($s['servico']) . "' $selected>" . htmlspecialchars($s['servico']) . " - R$ " . number_format($s['preco'], 2, ',', '.') . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="horario">Data e Horário:</label>
                <input type="datetime-local" name="horario" id="horario" value="<?=date('Y-m-d\TH:i', strtotime($agendamento['horario']))?>" required>
            </div>
            
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/agendamento/listar-agendamento">Cancelar</a>
            <a href="?query=admin/agendamento/painel-admin-agendamento">Voltar ao Painel</a>
        </div>
    </div>
</body>
</html>
<?php
    } else {
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento não encontrado</title>
</head>
<body>
    <div class="error-container">
        <h2>Agendamento não encontrado!</h2>
        <a href="?query=admin/agendamento/listar-agendamento">Voltar para lista</a>
    </div>
</body>
</html>
<?php
    }
?>
