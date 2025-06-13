<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManufacturerElement extends Model
{
    public function mfg(): HasMany
    {
        return $this->hasMany(Manufacturer::class,'id','mfg_id');
    }

    public function element(): HasMany
    {
        return $this->hasMany(Element::class,'id','element_id');
    }
}
