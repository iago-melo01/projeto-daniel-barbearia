<?php
    require_once __DIR__ . '/barbearia-paladinos.php';

    /**
     * Retorna faixas de 1 hora para a data (início => rótulo).
     * Ter–sex: 09:00–18:00 | Sáb: 09:00–14:00 | Dom/seg: nenhuma.
     */
    function obterFaixasHorarioPorData(string $data): array
    {
        $faixas = [];
        $dt = DateTime::createFromFormat('Y-m-d', $data);

        if (!$dt || $dt->format('Y-m-d') !== $data) {
            return $faixas;
        }

        $dia = (int) $dt->format('w');

        if ($dia === 0 || $dia === 1) {
            return $faixas;
        }

        $horaFim = ($dia === 6) ? 14 : 18;

        for ($h = 9; $h < $horaFim; $h++) {
            $inicio = sprintf('%02d:00', $h);
            $fim = sprintf('%02d:00', $h + 1);
            $faixas[$inicio] = $inicio . ' - ' . $fim;
        }

        return $faixas;
    }

    function barbeariaAbertaNaData(string $data): bool
    {
        return count(obterFaixasHorarioPorData($data)) > 0;
    }

    function obterDuracaoServicoMinutos(string $servico): ?int
    {
        $catalogo = obterCatalogoServicosPaladinos();
        return $catalogo[$servico]['duracao'] ?? null;
    }

    function servicoPermitidoAgendamento(string $servico): bool
    {
        return obterDuracaoServicoMinutos($servico) !== null;
    }

    function horarioDatetimeValido(string $datetime, string $data): bool
    {
        $dt = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
        if (!$dt || $dt->format('Y-m-d H:i:s') !== $datetime) {
            return false;
        }

        if ($dt->format('Y-m-d') !== $data) {
            return false;
        }

        $faixas = obterFaixasHorarioPorData($data);
        return array_key_exists($dt->format('H:i'), $faixas);
    }

    function montarDatetimeAgendamento(string $data, string $horaInicio): string
    {
        return $data . ' ' . $horaInicio . ':00';
    }

    /**
     * Verifica sobreposição entre dois intervalos na agenda (bloco fixo de 1 h).
     */
    function intervalosAgendaSobrepostos(DateTime $inicioA, DateTime $inicioB): bool
    {
        $fimA = (clone $inicioA)->modify('+' . BLOCO_AGENDA_MINUTOS . ' minutes');
        $fimB = (clone $inicioB)->modify('+' . BLOCO_AGENDA_MINUTOS . ' minutes');

        return $inicioA < $fimB && $fimA > $inicioB;
    }

    function calcularHorariosOcupadosParaData(string $data, array $faixas, array $horariosReservados): array
    {
        $ocupados = [];
        $reservas = [];

        foreach ($horariosReservados as $horarioCompleto) {
            $inicio = DateTime::createFromFormat('Y-m-d H:i:s', $horarioCompleto);
            if ($inicio) {
                $reservas[] = $inicio;
            }
        }

        foreach (array_keys($faixas) as $horaInicio) {
            $slotInicio = DateTime::createFromFormat('Y-m-d H:i:s', $data . ' ' . $horaInicio . ':00');
            if (!$slotInicio) {
                continue;
            }

            foreach ($reservas as $reserva) {
                if (intervalosAgendaSobrepostos($slotInicio, $reserva)) {
                    $ocupados[] = $horaInicio;
                    break;
                }
            }
        }

        return array_values(array_unique($ocupados));
    }

    function horarioConflitaComAgenda(string $novoHorario, int $barbeiro, PDO $pdo): bool
    {
        $inicioNovo = DateTime::createFromFormat('Y-m-d H:i:s', $novoHorario);
        if (!$inicioNovo) {
            return true;
        }

        $data = $inicioNovo->format('Y-m-d');

        $stmt = $pdo->prepare(
            'SELECT horario FROM agendamento
             WHERE DATE(horario) = :data AND barbeiro = :barbeiro'
        );
        $stmt->execute(['data' => $data, 'barbeiro' => $barbeiro]);

        while ($row = $stmt->fetch()) {
            $inicioExistente = DateTime::createFromFormat('Y-m-d H:i:s', $row['horario']);
            if ($inicioExistente && intervalosAgendaSobrepostos($inicioNovo, $inicioExistente)) {
                return true;
            }
        }

        return false;
    }
