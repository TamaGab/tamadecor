<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{

    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'address',
        'phone',
        'email',
        'notes'
    ];


    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getCpfFormatadoAttribute()
    {
        if (!preg_match('/^\d{11}$/', $this->cpf)) return $this->cpf;

        return substr($this->cpf, 0, 3) . '.' .
            substr($this->cpf, 3, 3) . '.' .
            substr($this->cpf, 6, 3) . '-' .
            substr($this->cpf, 9, 2);
    }

    public function getPhoneFormatadoAttribute()
    {
        if (!preg_match('/^\d{10,11}$/', $this->phone)) return $this->phone;

        return strlen($this->phone) === 11
            ? '(' . substr($this->phone, 0, 2) . ') ' . substr($this->phone, 2, 5) . '-' . substr($this->phone, 7)
            : '(' . substr($this->phone, 0, 2) . ') ' . substr($this->phone, 2, 4) . '-' . substr($this->phone, 6);
    }
}
