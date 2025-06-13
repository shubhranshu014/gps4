<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Technician extends Model
{
    public function dealer(): HasMany
    {
        return $this->hasMany(Dealer::class,'id','dealer_id');
    } 
    
}
