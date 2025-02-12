<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborCertification extends Model
{
    use HasFactory;

    protected $table = 'labor_certifications';

    protected $fillable = [
        'service_provider_id',
        'risk_level', // Grau de Risco
        'social_capital', // Capital Social
        'employees_number', // Nº de Empregados
        'capital_per_employee', // Proporção Capital/Empregados
        'retention_clause', // Cláusula de Retenção
        'fgts_certificate', // Certidão de FGTS
        'labor_certificate', // Certidão Trabalhista
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
