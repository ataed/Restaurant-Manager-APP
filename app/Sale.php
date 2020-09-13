<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //1:Many relationship
    public function saleDetails(){
        return $this->hasMany(SaleDetail::class);
    }
}