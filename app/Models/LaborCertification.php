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
        'number_of_employees', // Nº de Empregados
        'capital_employee_ratio', // Proporção Capital/Empregados
        'retention_clause', // Cláusula de Retenção
        'fgts_certificate', // Certidão de FGTS
        'labor_certificate', // Certidão Trabalhista
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
