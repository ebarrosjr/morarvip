<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\I18n\Date;

class IdadeHelper extends Helper
{
    /**
     * Calcula idade formatada
     *
     * @param string|\DateTimeInterface|Date $dataNascimento
     * @param bool $incluirDias Se deve incluir dias no cálculo
     * @param bool $ocultarZeros Se deve ocultar partes iguais a zero
     * @return string Exemplo: "70 anos, 11 meses e 12 dias"
     */
    public function calcular($dataNascimento, bool $incluirDias = false, bool $ocultarZeros = true): string
    {
        if (is_string($dataNascimento)) {
            $nascimento = Date::createFromFormat('Y-m-d', $dataNascimento);
        } elseif ($dataNascimento instanceof Date) {
            $nascimento = $dataNascimento;
        } elseif ($dataNascimento instanceof \DateTimeInterface) {
            $nascimento = new Date($dataNascimento->format('Y-m-d'));
        } else {
            return '<span class="text-danger">Não disponível</span>';
            //throw new \InvalidArgumentException('Formato de data inválido');
        }

        $hoje = Date::today();

        // Calcula anos
        $anos = $hoje->diffInYears($nascimento);

        // Ajusta data de nascimento somando os anos já completos
        $ajustado = $nascimento->addYears($anos);
        $meses = $ajustado->diffInMonths($hoje);

        // Ajusta para meses também e calcula dias restantes
        $ajustado = $ajustado->addMonths($meses);
        $dias = $ajustado->diffInDays($hoje);

        $partes = [];

        if (!$ocultarZeros || $anos > 0) {
            $partes[] = $anos . ' ' . ($anos === 1 ? 'ano' : 'anos');
        }
        if (!$ocultarZeros || $meses > 0) {
            $partes[] = $meses . ' ' . ($meses === 1 ? 'mês' : 'meses');
        }
        if ($incluirDias && (!$ocultarZeros || $dias > 0)) {
            $partes[] = $dias . ' ' . ($dias === 1 ? 'dia' : 'dias');
        }

        if (empty($partes)) {
            return '0 dias';
        }

        // Junta com vírgula e "e" antes da última parte
        if (count($partes) > 1) {
            $ultima = array_pop($partes);
            return implode(', ', $partes) . ' e ' . $ultima;
        }

        return $partes[0];
    }
}
