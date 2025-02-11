<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalCertification extends Model
{
    use HasFactory;

    protected $table = 'fiscal_certifications';

    protected $fillable = [
        'service_provider_id',
        'federal_tax_certificate', // Certidão de Regularidade de Tributos Federais
        'state_tax_certificate', // Certidão de Regularidade de Tributos Estaduais
        'municipal_tax_certificate', // Certidão de Regularidade de Tributos Municipais
        'debt_clearance_certificate', // CND - Certidão Negativa de Débitos Relativos aos Tributos Federais e à Dívida Ativa da União
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
