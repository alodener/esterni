<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Alterado aqui
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Authenticatable // Alterado aqui
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'cnpj', 'password', 'status'];

    protected $hidden = ['password'];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class);
    }
}
