<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssignElementAdmin extends Model
{
    public function admin(): HasMany
    {
        return $this->hasMany(Admin::class,'id','admin_id');
    }

    public function element(): HasMany
    {
        return $this->hasMany(Element::class,'id','element_id');
    }
}

