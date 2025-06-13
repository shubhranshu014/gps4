<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestingAgency extends Model
{
    public function elements(): HasMany
    {
        return $this->hasMany(Element::class,'id','element_id');
    }

    public function type(): HasMany
    {
        return $this->hasMany(ElementType::class,'id','type_id');
    }

    public function model(): HasMany
    {
        return $this->hasMany(ModelNo::class,'id','model_id');
    }

    public function part(): HasMany
    {
        return $this->hasMany(PartNo::class,'id','part_id');
    }

    public function tac(): HasMany
    {
        return $this->hasMany(Tac::class,'id','tacNo');
    }

    public function cop(): HasMany
    {
        return $this->hasMany(Cop::class,'id','copNo');
    }

}
