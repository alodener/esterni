<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationalTrainings extends Model
{
    use HasFactory;

    protected $table = 'occupational_trainings';

    protected $fillable = [
        'service_provider_id',
        'nr_01_general_safety',
        'nr_04_epi',
        'nr_18_construction',
        'nr_35_work_at_height',
        'nr_10_electricity',
        'nr_11_transport_handling',
        'nr_14_furnaces',
        'nr_17_ergonomics',
        'nr_19_explosives'
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
