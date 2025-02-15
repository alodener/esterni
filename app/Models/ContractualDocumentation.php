<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractualDocumentation extends Model
{
    use HasFactory;

    protected $table = 'employee_contractual_docs';

    protected $fillable = [
        'service_provider_id',
        'admission_protocol',
        'employment_contract',
        'code_of_ethics',
        'cnh_for_drivers',
        'federal_police_license',
        'professional_council_certificate',
        'electrical_course_certificate',
        'cct_or_act'
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
