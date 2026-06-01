<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
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
adminHead('Novo Agendamento');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Novo Agendamento', array (
  0 => 
  array (
    'url' => '?query=admin/agendamento/painel-admin-agendamento',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/agendamento/agendamento-inserir" method="post">
            <div class="form-group">
                <label for="barbeiro">Barbeiro:</label>
                <select name="barbeiro" id="barbeiro" required>
                    <option value="">Selecione um barbeiro</option>
                    <?php
                        if(mysqli_num_rows($barbeiros) > 0) {
                            while($barbeiro = mysqli_fetch_array($barbeiros)) {
                                echo "<option value='" . $barbeiro['id'] . "'>" . $barbeiro['nome'] . "</option>";
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
                            while($servico = mysqli_fetch_array($servicos)) {
                                echo "<option value='" . $servico['servico'] . "'>" . $servico['servico'] . " - R$ " . number_format($servico['preco'], 2, ',', '.') . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="horario">Data e Horário:</label>
                <input type="datetime-local" name="horario" id="horario" required>
            </div>
            
            <button type="submit" class="btn-submit">Marcar Agendamento</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/agendamento/listar-agendamento">Ver Agendamentos</a>
            <a href="?query=admin/agendamento/painel-admin-agendamento">Voltar ao Painel</a>
        </div>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
