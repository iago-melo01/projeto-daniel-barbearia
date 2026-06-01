<?php
    require_once __DIR__ . '/admin/conectaPDO.php';
    require_once __DIR__ . '/includes/horarios-agendamento.php';

    $catalogoServicos = obterCatalogoServicosPaladinos();
    $horariosFuncionamento = obterHorarioFuncionamentoTexto();

    $mensagem_agendamento = '';
    $tipoMensagem_agendamento = '';
    $mensagem_cliente = '';
    $tipoMensagem_cliente = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome_cliente = trim($_POST['nome_cliente'] ?? '');
        $email_cliente = trim($_POST['email_cliente'] ?? '');
        $telefone_cliente = trim($_POST['telefone_cliente'] ?? '');
        $barbeiro = filter_var($_POST['barbeiro'] ?? '', FILTER_VALIDATE_INT);
        $servico = trim($_POST['servico'] ?? '');
        $horario = trim($_POST['horario'] ?? '');
        $data_agenda = trim($_POST['data_agenda'] ?? '');

        $erros = [];

        if ($nome_cliente === '') {
            $erros[] = 'Informe seu nome.';
        }
        if (!filter_var($email_cliente, FILTER_VALIDATE_EMAIL)) {
            $erros[] = 'Informe um e-mail válido.';
        }
        if ($telefone_cliente === '') {
            $erros[] = 'Informe seu telefone.';
        }
        if ($barbeiro === false || $barbeiro < 1) {
            $erros[] = 'Selecione um barbeiro.';
        }
        if (!servicoPermitidoAgendamento($servico)) {
            $erros[] = 'Selecione um serviço válido.';
        }
        if ($horario === '') {
            $erros[] = 'Selecione um horário disponível.';
        }
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_agenda)) {
            $erros[] = 'Data de agendamento inválida.';
        } elseif (!barbeariaAbertaNaData($data_agenda)) {
            $erros[] = 'A barbearia não funciona aos domingos e segundas-feiras.';
        }

        if ($horario !== '' && $data_agenda !== '' && !horarioDatetimeValido($horario, $data_agenda)) {
            $erros[] = 'Horário selecionado não é permitido para este dia.';
        }

        if (empty($erros) && $horario !== '' && $barbeiro) {
            if (horarioConflitaComAgenda($horario, $barbeiro, $pdo)) {
                $erros[] = 'Este horário já está reservado ou conflita com outro agendamento. Escolha outro.';
            }
        }

        if (empty($erros)) {
            try {
                $pdo->beginTransaction();

                $sqlAgendamento = 'INSERT INTO agendamento
                    (nome_cliente, email_cliente, telefone_cliente, barbeiro, servico, horario)
                    VALUES (:nome, :email, :telefone, :barbeiro, :servico, :horario)';

                $stmtAgendamento = $pdo->prepare($sqlAgendamento);
                $stmtAgendamento->execute([
                    'nome' => $nome_cliente,
                    'email' => $email_cliente,
                    'telefone' => $telefone_cliente,
                    'barbeiro' => $barbeiro,
                    'servico' => $servico,
                    'horario' => $horario,
                ]);

                $stmtCliente = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
                $stmtCliente->execute(['email' => $email_cliente]);

                if (!$stmtCliente->fetch()) {
                    $stmtNovoCliente = $pdo->prepare(
                        'INSERT INTO usuarios (cliente, email, telefone) VALUES (:nome, :email, :telefone)'
                    );
                    $stmtNovoCliente->execute([
                        'nome' => $nome_cliente,
                        'email' => $email_cliente,
                        'telefone' => $telefone_cliente,
                    ]);
                    $mensagem_cliente = 'Cliente cadastrado com sucesso.';
                    $tipoMensagem_cliente = 'success';
                }

                $pdo->commit();
                $mensagem_agendamento = MENSAGEM_AGENDAMENTO_SUCESSO;
                $tipoMensagem_agendamento = 'success';
            } catch (PDOException $e) {
                $pdo->rollBack();
                if ((int) $e->errorInfo[1] === 1062) {
                    $mensagem_agendamento = 'Este horário já está reservado. Escolha outro.';
                } else {
                    $mensagem_agendamento = 'Erro ao realizar agendamento. Tente novamente.';
                }
                $tipoMensagem_agendamento = 'error';
            }
        } else {
            $mensagem_agendamento = implode(' ', $erros);
            $tipoMensagem_agendamento = 'error';
        }
    }

    $stmtBarbeiros = $pdo->query('SELECT id, nome FROM barbeiros ORDER BY nome');
    $barbeiros = $stmtBarbeiros->fetchAll();

    $stmtServicos = $pdo->query('SELECT servico, preco FROM servicos ORDER BY servico');
    $servicosDb = $stmtServicos->fetchAll();

    $servicos = [];
    foreach ($servicosDb as $item) {
        $nome = $item['servico'];
        if (!isset($catalogoServicos[$nome])) {
            continue;
        }
        $servicos[] = [
            'servico' => $nome,
            'preco' => $catalogoServicos[$nome]['preco'],
            'duracao' => $catalogoServicos[$nome]['duracao'],
        ];
    }

    $dataMinima = (new DateTime('today'))->format('Y-m-d');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar - <?= htmlspecialchars(NOME_BARBEARIA) ?></title>
    <?php include_once __DIR__ . '/includes/layout-head.php'; ?>
    <?php require_once __DIR__ . '/includes/site.php'; ?>
</head>
<body>
    <?php include_once 'topo.php'; ?>
    <div class="page-container--narrow">
        <div class="pal-card">
            <div class="form-brand">
                <img
                    src="<?= htmlspecialchars(urlAsset(LOGO_PALADINOS)) ?>"
                    alt="<?= htmlspecialchars(NOME_BARBEARIA) ?>"
                    class="logo-form"
                >
                <p class="subtitulo">Agende seu horário online</p>
            </div>

            <aside class="info-panel">
                <h3>Horário de funcionamento</h3>
                <ul>
                    <?php foreach ($horariosFuncionamento as $linha): ?>
                        <li><?= htmlspecialchars($linha) ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>
                    Siga-nos no Instagram:
                    <a class="instagram-link" href="<?= htmlspecialchars(INSTAGRAM_BARBEARIA) ?>" target="_blank" rel="noopener noreferrer">
                        <?= htmlspecialchars(INSTAGRAM_USUARIO) ?>
                    </a>
                </p>
            </aside>

            <h2 class="form-page-title">Agendar Horário</h2>

            <?php if ($mensagem_agendamento): ?>
                <div class="alert alert-<?= htmlspecialchars($tipoMensagem_agendamento) ?>">
                    <?= htmlspecialchars($mensagem_agendamento) ?>
                </div>
            <?php elseif ($mensagem_cliente): ?>
                <div class="alert alert-<?= htmlspecialchars($tipoMensagem_cliente) ?>">
                    <?= htmlspecialchars($mensagem_cliente) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="?query=agendar" id="form-agendar">
                <div class="form-group">
                    <label for="nome_cliente">Seu Nome Completo</label>
                    <input type="text" id="nome_cliente" name="nome_cliente" required placeholder="Digite seu nome">
                </div>

                <div class="form-group">
                    <label for="email_cliente">Seu E-mail</label>
                    <input type="email" id="email_cliente" name="email_cliente" required placeholder="seu.email@exemplo.com">
                </div>

                <div class="form-group">
                    <label for="telefone_cliente">Seu Telefone</label>
                    <input type="text" id="telefone_cliente" name="telefone_cliente" required placeholder="83999999999" maxlength="15">
                </div>

                <div class="form-group">
                    <label for="barbeiro">Escolha o Barbeiro</label>
                    <select id="barbeiro" name="barbeiro" required>
                        <option value="">Selecione um barbeiro</option>
                        <?php foreach ($barbeiros as $barbeiro): ?>
                            <option value="<?= (int) $barbeiro['id'] ?>">
                                <?= htmlspecialchars($barbeiro['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="servico">
                        Escolha o Serviço
                        <span class="label-dica">(cada reserva ocupa 1 hora na agenda)</span>
                    </label>
                    <select id="servico" name="servico" required>
                        <option value="">Selecione um serviço</option>
                        <?php foreach ($servicos as $servico): ?>
                            <option
                                value="<?= htmlspecialchars($servico['servico']) ?>"
                                data-duracao="<?= (int) $servico['duracao'] ?>"
                            >
                                <?= htmlspecialchars($servico['servico']) ?>
                                - R$ <?= number_format((float) $servico['preco'], 2, ',', '.') ?>
                                (<?= (int) $servico['duracao'] ?> min)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="data_agenda">Dia</label>
                    <input type="date" id="data_agenda" name="data_agenda" required min="<?= $dataMinima ?>">
                </div>

                <div class="horarios-section" id="horarios-section">
                    <div id="horarios-aviso-barbeiro" class="horarios-aviso" style="display: none;">
                        Selecione um barbeiro para ver os horários disponíveis.
                    </div>
                    <div id="horarios-aviso-fechado" class="horarios-aviso fechado" style="display: none;"></div>

                    <div class="horarios-header">
                        <h3 id="horarios-titulo">Horários</h3>
                        <span class="dica">clique para selecionar</span>
                    </div>

                    <div class="horarios-grid" id="horarios-grid" role="group" aria-label="Horários disponíveis"></div>

                    <p class="horarios-rodape">Mude a data acima para adicionar horários em outros dias</p>
                </div>

                <input type="hidden" name="horario" id="horario" value="">

                <button type="submit" class="btn-submit" id="btn-submit" disabled>Confirmar Agendamento</button>
            </form>
        </div>
    </div>

    <?php include_once __DIR__ . '/includes/rodape.php'; ?>

    <script>
        (function () {
            const API_URL = '?query=api/horarios-ocupados';

            const dataInput = document.getElementById('data_agenda');
            const barbeiroSelect = document.getElementById('barbeiro');
            const horarioHidden = document.getElementById('horario');
            const section = document.getElementById('horarios-section');
            const grid = document.getElementById('horarios-grid');
            const titulo = document.getElementById('horarios-titulo');
            const avisoBarbeiro = document.getElementById('horarios-aviso-barbeiro');
            const avisoFechado = document.getElementById('horarios-aviso-fechado');
            const btnSubmit = document.getElementById('btn-submit');

            let faixasAtuais = {};

            const diasSemana = ['dom.', 'seg.', 'ter.', 'qua.', 'qui.', 'sex.', 'sáb.'];

            function formatarTituloData(isoDate) {
                const [y, m, d] = isoDate.split('-').map(Number);
                const dt = new Date(y, m - 1, d);
                const dia = diasSemana[dt.getDay()];
                const dd = String(d).padStart(2, '0');
                const mm = String(m).padStart(2, '0');
                return `Horários de ${dia}, ${dd}/${mm}`;
            }

            function limparSelecao() {
                horarioHidden.value = '';
                btnSubmit.disabled = true;
                grid.querySelectorAll('.slot-btn.selecionado').forEach((el) => {
                    el.classList.remove('selecionado');
                });
            }

            function renderizarSlots(ocupados) {
                grid.innerHTML = '';
                limparSelecao();

                const data = dataInput.value;
                if (!data || Object.keys(faixasAtuais).length === 0) {
                    return;
                }

                Object.entries(faixasAtuais).forEach(([inicio, label]) => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'slot-btn';
                    btn.dataset.hora = inicio;

                    if (ocupados.includes(inicio)) {
                        btn.textContent = 'Reservado';
                        btn.classList.add('reservado');
                        btn.disabled = true;
                    } else {
                        btn.textContent = label;
                        btn.addEventListener('click', () => {
                            grid.querySelectorAll('.slot-btn.selecionado').forEach((el) => {
                                el.classList.remove('selecionado');
                            });
                            btn.classList.add('selecionado');
                            horarioHidden.value = `${data} ${inicio}:00`;
                            btnSubmit.disabled = false;
                        });
                    }

                    grid.appendChild(btn);
                });
            }

            async function carregarHorarios() {
                const data = dataInput.value;
                const barbeiro = barbeiroSelect.value;

                limparSelecao();
                avisoFechado.style.display = 'none';
                faixasAtuais = {};

                if (!data) {
                    section.classList.remove('visivel');
                    return;
                }

                section.classList.add('visivel');
                titulo.textContent = formatarTituloData(data);

                if (!barbeiro) {
                    avisoBarbeiro.style.display = 'block';
                    grid.innerHTML = '<p class="horarios-vazio">Escolha o barbeiro para listar os horários.</p>';
                    return;
                }

                avisoBarbeiro.style.display = 'none';
                grid.innerHTML = '<p class="horarios-carregando">Carregando horários...</p>';

                try {
                    const params = new URLSearchParams({ data, barbeiro });
                    const res = await fetch(`${API_URL}&${params.toString()}`);
                    const json = await res.json();

                    if (!res.ok) {
                        throw new Error(json.erro || 'Erro ao carregar horários.');
                    }

                    if (json.fechado) {
                        avisoFechado.textContent = json.mensagem || 'Barbearia fechada neste dia.';
                        avisoFechado.style.display = 'block';
                        grid.innerHTML = '';
                        return;
                    }

                    faixasAtuais = json.faixas || {};
                    renderizarSlots(json.ocupados || []);
                } catch (err) {
                    grid.innerHTML = `<p class="horarios-vazio">${err.message}</p>`;
                }
            }

            dataInput.addEventListener('change', carregarHorarios);
            barbeiroSelect.addEventListener('change', carregarHorarios);

            document.getElementById('form-agendar').addEventListener('submit', (e) => {
                if (!horarioHidden.value) {
                    e.preventDefault();
                    alert('Selecione um horário disponível antes de confirmar.');
                }
            });
        })();
    </script>
</body>
</html>
