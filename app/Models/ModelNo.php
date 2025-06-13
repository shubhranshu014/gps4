<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelNo extends Model
{
    public function elements(): HasMany
    {
        return $this->hasMany(Element::class,'id','element_id');
    }

    public function type(): HasMany
    {
        return $this->hasMany(ElementType::class,'id','type_id');
    }
}
