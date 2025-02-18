<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollAudit extends Model
{
    use HasFactory;

    protected $table = 'payroll_audits';

    protected $fillable = [
        'month',
        'year',
        'service_provider_id',

        'payroll_entries_correct',
        'payroll_compliance',
        'benefits_paid_correctly',
        'leave_records_correct',

        'work_schedules_presented',
        'work_records_compliant',
        'overtime_compliant',
        'rest_periods_complied',

        'tax_guides_presented',
        'fgts_compliance',
        'inss_compliance',
        'ir_compliance',

        'cat_submitted_on_time',
        'cipa_training',
        'medical_certificates_presented',
        'accident_investigation_presented',
    ];

    protected $appends = [
        'payroll_average_score',
        'work_journey_average_score',
        'taxes_average_score',
        'sst_average_score',
        'total_average_score'
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function getMonthNameAttribute()
    {
        $months = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];

        return $months[$this->month] ?? 'Mês inválido';
    }

    /**
     * Mapeamento de pontuação para cada resposta
     */
    private function getScore($value)
    {
        $scores = [
            '' => 0,
            null => 0,
            'Conforme' => 25,
            'Não Conforme' => 0,
            'Conforme Parcialmente' => 15,
            'Não se aplica' => 25,
        ];

        return $scores[$value] ?? 0;
    }

    /**
     * Calcula a média de um conjunto de campos
     */
    private function calculateAverageScore(array $fields)
    {
        $totalScore = 0;
        $validFields = 0;

        foreach ($fields as $field) {
            $score = $this->getScore($this->{$field});
            $totalScore += $score;
            $validFields++;
        }

        return $validFields > 0 ? round($totalScore / $validFields, 2) : 0;
    }

    /**
     * Média da Folha de Pagamento
     */
    public function getPayrollAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'payroll_entries_correct',
            'payroll_compliance',
            'benefits_paid_correctly',
            'leave_records_correct'
        ]);
    }

    /**
     * Média da Jornada de Trabalho
     */
    public function getWorkJourneyAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'work_schedules_presented',
            'work_records_compliant',
            'overtime_compliant',
            'rest_periods_complied'
        ]);
    }

    /**
     * Média dos Encargos Trabalhistas
     */
    public function getTaxesAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'tax_guides_presented',
            'fgts_compliance',
            'inss_compliance',
            'ir_compliance'
        ]);
    }

    /**
     * Média de Saúde e Segurança do Trabalho (SST)
     */
    public function getSstAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'cat_submitted_on_time',
            'cipa_training',
            'medical_certificates_presented',
            'accident_investigation_presented'
        ]);
    }

    /**
     * Média Total
     */
    public function getTotalAverageScoreAttribute()
    {
        $scores = [
            $this->payroll_average_score,
            $this->work_journey_average_score,
            $this->taxes_average_score,
            $this->sst_average_score
        ];

        return round(array_sum($scores) / count($scores), 2);
    }
}
