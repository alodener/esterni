<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollAudit extends Model
{
    use HasFactory;

    protected $table = 'payroll_audits';

    protected $fillable = [
        'month',
        'year',
        'service_provider_id',

        'payroll_entries_correct',
        'payroll_compliance',
        'benefits_paid_correctly',
        'leave_records_correct',

        'work_schedules_presented',
        'work_records_compliant',
        'overtime_compliant',
        'rest_periods_complied',

        'tax_guides_presented',
        'fgts_compliance',
        'inss_compliance',
        'ir_compliance',
        
        'cat_submitted_on_time',
        'cipa_training',
        'medical_certificates_presented',
        'accident_investigation_presented',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
