<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'service_provider_id',
        'photo',
        'system_enable_date',
        'client_name',
        'provider_name',
        'provider_cnpj',
        'employee_name',
        'admission_date',
        'dismissal_date',
        'job_title',
        'salary',
        'insalubrity',
        'dangerousness',
        'work_schedule',
        'night_shift',
        'department',
        'start_client_allocation',
        'end_client_allocation',
    ];

    protected $casts = [
        'system_enable_date' => 'date',
        'admission_date' => 'date',
        'dismissal_date' => 'date',
        'start_client_allocation' => 'date',
        'end_client_allocation' => 'date',
        'salary' => 'decimal:2',
        'insalubrity' => 'boolean',
        'dangerousness' => 'boolean',
        'night_shift' => 'boolean',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
