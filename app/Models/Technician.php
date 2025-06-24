<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Technician extends Authenticatable
{
    use HasFactory, Notifiable;
    protected function casts(): array
    {
        
        return [
            'password' => 'hashed',
        ];
    }

    public function dealer(): HasMany
    {
        return $this->hasMany(Dealer::class,'id','dealer_id');
    } 
    
}
