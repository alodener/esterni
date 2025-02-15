<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationalHealthSafety extends Model
{
    use HasFactory;

    protected $table = 'occupational_health_safety';

    protected $fillable = [
        'service_provider_id',
        'aso',
        'complementary_exams',
        'work_order',
        'epi_uniform_record',
        'esocial_events_submission'
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
