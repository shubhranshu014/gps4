<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarCode extends Model
{
    public function manufacturer(): HasMany
    {
        return $this->hasMany(Manufacturer::class, 'id', 'mfg_id');

    }
    public function element(): HasMany
    {
        return $this->hasMany(Element::class, 'id', 'element_id');
    }
    public function elementType(): HasMany
    {
        return $this->hasMany(ElementType::class, 'id', 'type_id');
    }

    public function modelNo(): HasMany
    {
        return $this->hasMany(ModelNo::class, 'id', 'model_id');
    }

    public function partNo(): HasMany
    {
        return $this->hasMany(PartNo::class, 'id', 'part_id');
    }

    public function tacNo(): HasMany
    {
        return $this->hasMany(Tac::class, 'id', 'tac_id');
    }
}
