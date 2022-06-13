<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productCharacteristic extends Model
{
    protected $table = 'product_characteristic';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(
            'App\Product',
            'product_characteristic_id',
            'id'
        );
    }
}
