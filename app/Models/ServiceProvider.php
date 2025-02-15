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
}
