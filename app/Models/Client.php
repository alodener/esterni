<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'cnpj', 'password', 'status'];

    protected $hidden = ['password'];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
