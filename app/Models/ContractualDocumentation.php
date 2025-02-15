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
        'ethics_code',
        'driver_license',
        'federal_police_clearance',
        'professional_council_certificate',
        'electrical_course_certificate',
        'collective_agreement'
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
