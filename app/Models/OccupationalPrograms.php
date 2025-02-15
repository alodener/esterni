<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationalPrograms extends Model
{
    use HasFactory;

    protected $table = 'occupational_programs';

    protected $fillable = [
        'service_provider_id',
        'ltcat',
        'pgr',
        'pcms_o',
        'insalubrity_report',
        'danger_report',
        'aet'
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
