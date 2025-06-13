<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AllocatedBarCode extends Model
{
    public function barcode(): HasOne
    {
        return $this->hasOne(BarCode::class, 'id','barcode_id');
    }

    public function distributor(): HasOne
    {
        return $this->hasOne(Distributor::class, 'id','distributor_id');
    }

    public function dealer(): HasOne
    {
        return $this->hasOne(Dealer::class, 'id','dealer_id');
    }
}
