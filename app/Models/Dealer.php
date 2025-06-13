<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dealer extends Authenticatable
{
    use HasFactory, Notifiable;
    public function distributor(): HasOne
    {
        return $this->hasOne(Distributor::class, 'id', 'distributor_id');
    }
    protected function casts(): array
    {

        return [
            'password' => 'hashed',
            'rto_devision' => 'array',

        ];
    }


    public function technicians()
    {
        return $this->hasMany(Technician::class, 'dealer_id');
    }
}
