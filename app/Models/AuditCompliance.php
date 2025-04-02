<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditCompliance extends Model
{
    use HasFactory;

    protected $table = 'audit_compliances';

    protected $fillable = [
        'service_provider_id',
        'year',

        'payroll_thirteenth_launches',
        'payroll_thirteenth_fgts',
        'payroll_thirteenth_inss',
        'payroll_thirteenth_ir',

        'vacation_granted_on_time',
        'vacation_paid_on_time',
        'vacation_planning',
        'vacation_documentation',

        'occupational_exams',
        'occupational_programs',
        'occupational_trainings',
        'esocial_events',

        'salary_cct_act',
        'special_work_shifts_cct_act',
        'benefits_cct_act',
        'fgts_balance_deposited',

        'payroll_notes',
        'work_schedule_notes',
        'tax_obligations_notes',
        'health_safety_notes',
    ];

    /**
     * Relacionamento com o prestador de serviço.
     */
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
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

    private function calculateAverageScore(array $fields)
    {
        $totalScore = 0;
        $validFields = 0;

        foreach ($fields as $field) {
            $score = $this->getScore($this->{$field});
            $totalScore += $score;
            $validFields++;
        }

        return $validFields > 0 ? round($totalScore, 2) : 0;
        // return $validFields > 0 ? round($totalScore / $validFields, 2) : 0;
    }

    /**
     * Média da Folha 13º
     */
    public function getPayrollThirteenthAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'payroll_thirteenth_launches',
            'payroll_thirteenth_fgts',
            'payroll_thirteenth_inss',
            'payroll_thirteenth_ir'
        ]);
    }

    /**
     * Média das Férias
     */
    public function getVacationAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'vacation_granted_on_time',
            'vacation_paid_on_time',
            'vacation_planning',
            'vacation_documentation'
        ]);
    }

    /**
     * Média de Saúde e Segurança no Trabalho
     */
    public function getOccupationalHealthAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'occupational_exams',
            'occupational_programs',
            'occupational_trainings',
            'esocial_events'
        ]);
    }

    /**
     * Média de CCT/ACT e FGTS
     */
    public function getCctActFgtsAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'salary_cct_act',
            'special_work_shifts_cct_act',
            'benefits_cct_act',
            'fgts_balance_deposited'
        ]);
    }

    /**
     * Média Total
     */
    public function getTotalAverageScoreAttribute()
    {
        $scores = [
            $this->payroll_thirteenth_average_score,
            $this->vacation_average_score,
            $this->occupational_health_average_score,
            $this->cct_act_fgts_average_score
        ];

        return round(array_sum($scores) / count($scores), 2);
    }
}
