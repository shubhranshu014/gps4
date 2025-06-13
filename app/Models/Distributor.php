<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Distributor extends Authenticatable
{
    use HasFactory, Notifiable;
    protected function casts(): array
    {


        return [
            'password' => 'hashed',
            'districts' => 'array',
        ];



    }

    public function dealers()
    {
        return $this->hasMany(Dealer::class, 'distributor_id');
    }
}
