<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalCertification extends Model
{
    use HasFactory;

    protected $table = 'legal_certifications';

    protected $fillable = [
        'service_provider_id',
        'cnpj_card', // Cartão de CNPJ
        'incorporation_act', // Ato Constitutivo, Estatuto ou Contrato Social
        'partners_identification', // RG, CPF dos Sócios e Administradores
        'operating_license', // Alvará de Funcionamento
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
