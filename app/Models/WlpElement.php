<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WlpElement extends Model
{
    public function wlp(): HasMany
    {
        return $this->hasMany(Wlp::class,'id','wlp_id');
    }

    public function element(): HasMany
    {
        return $this->hasMany(Element::class,'id','element_id');
    }
}
