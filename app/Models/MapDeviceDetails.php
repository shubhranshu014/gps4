<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MapDeviceDetails extends Model
{
    public function barcodes(): HasOne
    {
        return $this->HasOne(BarCode::class, 'id','device_seriel_no');
    }

    public function dealer(): HasOne{

        return $this->HasOne(Dealer::class, 'id','dealer_id');
    }

    public function cusmtomer(): HasOne{

        return $this->HasOne(MapDevice::class, 'id','mapDevice_id');
    }

    public function package():HasOne{
        return $this->HasOne(Subscription::class,'id','package_id');
    }




}
