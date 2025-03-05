<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProvider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ // Campos que podem ser preenchidos em massa
        'company_name',
        'provider_cnpj',
        'social_purpose',
        'company_type',
        'company_opening_date',
        'share_capital',
        'managing_partner_1',
        'managing_partner_2',
        'managing_partner_3',
        'managing_partner_4',
        'risk_level',
        'service_provided',
        'relationship_contact',
        'contract_start_date',
        'contract_end_date',
        'monthly_base_value',
        'retention_clause',
        'number_of_contracted_employees',
        'client_id',
    ];

    // Relacionamento com o cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employees ()
    {
        return $this->hasMany(Employee::class);
    }

    // Relação 1:1 com Habilitação Jurídica
    public function legalCertification()
    {
        return $this->hasOne(LegalCertification::class);
    }

    // Relação 1:1 com Habilitação Trabalhista
    public function laborCertification()
    {
        return $this->hasOne(LaborCertification::class);
    }

    // Relação 1:1 com Habilitação Fiscal
    public function fiscalCertification()
    {
        return $this->hasOne(FiscalCertification::class);
    }

    // Relação 1:1 com Habilitação Econômica
    public function economicCertification()
    {
        return $this->hasOne(EconomicCertification::class);
    }

    public function contractualDocumentation()
    {
        return $this->hasOne(ContractualDocumentation::class);
    }

    public function occupationalPrograms()
    {
        return $this->hasOne(OccupationalPrograms::class);
    }

    public function occupationalHealthSafety()
    {
        return $this->hasOne(OccupationalHealthSafety::class);
    }

    public function occupationalTrainings()
    {
        return $this->hasOne(OccupationalTrainings::class);
    }

    public function payrollAudits()
    {
        return $this->hasMany(PayrollAudit::class);
    }

    public function auditCompliances()
    {
        return $this->hasMany(AuditCompliance::class);
    }

    // NOTE: MEDIAS

        /**
     * Mapeamento de pontuação para cada resposta
     */
    private function getScore($value, $field)
    {
        $numericFields = [
            'risk_level', 'share_capital', 'employees_number', 'capital_per_employee',
            'contract_start_end'
        ];

        if (in_array($field, $numericFields)) {
            return empty($value) ? 0 : 25;
        }

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

    private function getScoreContratacao($value, $field)
    {
        $numericFields = [
            'risk_level', 'share_capital', 'employees_number', 'capital_per_employee',
            'contract_start_end'
        ];

        if (in_array($field, $numericFields)) {
            return empty($value) ? 0 : 25;
        }

        $scores = [
            '' => 0,
            null => 0,
            'Conforme' => 20,
            'Não Conforme' => 0,
            'Conforme Parcialmente' => 10,
            'Não se aplica' => 20,
        ];

        return $scores[$value] ?? 0;
    }

    /**
     * Calcula a média de um conjunto de campos
     */
    private function calculateAverageScore(array $fields, string $relation)
    {
        $totalScore = 0;
        $validFields = 0;
// try {
    //code...
    foreach ($fields as $field) {
        if(!is_null($this->{$relation})){

            $score = $this->getScore($this->{$relation}->{$field}, $field);
        }
        $totalScore += $score ?? 0;
        $validFields++;
    }

// } catch (\Throwable $th) {
//     dd($fields, $relation, $th->getMessage(), $this->legalCertification);
// }
    return $validFields > 0 ? round($totalScore, 2) : 0;
    }

    private function calculateAverageScoreContratacao(array $fields, string $relation)
    {
        $totalScore = 0;
        $validFields = 0;

        foreach ($fields as $field) {
            $score = $this->getScoreContratacao($this->{$relation}->{$field}, $field);
            $totalScore += $score;
            $validFields++;
        }

        return $validFields > 0 ? round($totalScore, 2) : 0;
    }

    /**
     * Média da Certificação Jurídica
     */
    public function getLegalCertificationAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'cnpj_card', 'incorporation_act', 'partners_identification', 'operating_license'
        ], 'legalCertification');
    }

    /**
     * Média da Certificação Trabalhista
     */
    public function getLaborCertificationAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'capital_per_employee',
            'retention_clause', 'fgts_certificate', 'labor_certificate'
        ], 'laborCertification');
    }

    /**
     * Média da Certificação Fiscal
     */
    public function getFiscalCertificationAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'federal_tax_certification', 'state_tax_certification', 'municipal_tax_certification', 'cnd_federal_debt'
        ], 'fiscalCertification');
    }

    /**
     * Média da Certificação Econômica
     */
    public function getEconomicCertificationAverageScoreAttribute()
    {
        return $this->calculateAverageScore([
            'calculation_memory', 'bankruptcy_certificate',
            'dre_balance_sheet', 'issues_invoice'
        ], 'economicCertification');
    }

    // NOTE: media funcionarios

    public function getContractualDocumentationScoreAttribute()
    {
        return $this->calculateAverageScoreContratacao([
            'admission_protocol', 'employment_contract', 'ethics_code', 'professional_council_certificate', 'collective_agreement'
        ], 'contractualDocumentation');
    }

    /**
     * Média da Certificação Trabalhista
     */
    public function getOccupationalProgramsScoreAttribute()
    {
        return $this->calculateAverageScoreContratacao([
            'ltcat', 'pcmso', 'insalubrity_report', 'danger_report', 'aet'
        ], 'occupationalPrograms');
    }

    /**
     * Média da Certificação Fiscal
     */
    public function getOccupationalHealthSafetyScoreAttribute()
    {
        return $this->calculateAverageScoreContratacao([
            'aso', 'complementary_exams', 'work_order', 'epi_uniform_record', 'esocial_events_submission'
        ], 'occupationalHealthSafety');
    }

    /**
     * Média da Certificação Econômica
     */
    public function getOccupationalTrainingsScoreAttribute()
    {
        return $this->calculateAverageScoreContratacao([
            'nr_01_general_safety', 'nr_04_epi',
            'nr_18_construction', 'nr_35_work_at_height', 'nr_10_electricity'
        ], 'occupationalTrainings');
    }

    /**
     * Média Total
     */
    public function getTotalAverageScoreAttribute()
    {
        $scores = [
            $this->legal_certification_average_score,
            $this->labor_certification_average_score,
            $this->fiscal_certification_average_score,
            $this->economic_certification_average_score
        ];

        return round(array_sum($scores) / count($scores), 2);
    }

    public function getTotalAverageScoreContratacaoAttribute()
    {
        $scores = [
            $this->contractual_documentation_score,
            $this->occupational_programs_score,
            $this->occupational_healthSafety_score,
            $this->occupational_training_score
        ];

        return round(array_sum($scores) / count($scores), 2);
    }

}
