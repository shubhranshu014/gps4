<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ElementType extends Model
{
    protected $table = "element_types";
    public function elements(): HasMany
    {
        // Assuming 'element_type_id' is the foreign key on the Element model
        return $this->hasMany(Element::class, 'id','element_id');
    }
}

