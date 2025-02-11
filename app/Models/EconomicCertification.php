<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomicCertification extends Model
{
    use HasFactory;

    protected $table = 'economic_certifications';

    protected $fillable = [
        'service_provider_id',
        'contract_start_end', // Início/Fim do Contrato
        'company_size', // Porte
        'calculation_memory', // Memória de Cálculo
        'bankruptcy_certificate', // Certidão Negativa de Falência e Protesto
        'dre_balance_sheet', // DRE/Balancete
        'issues_invoice', // Emite Nota Fiscal?
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
