<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Manufacturer extends Authenticatable
{
    use HasFactory, Notifiable;

    public function wlp(): HasOne
    {
        return $this->hasOne(Wlp::class, 'id', 'parent_id');
    }
    protected function casts(): array
    {
        
        return [
            'password' => 'hashed',
        ];
    }
}
