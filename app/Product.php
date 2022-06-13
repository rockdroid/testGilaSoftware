<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'sku',
        'brand',
        'cost',
        'finalPrice',
        'size',
        'product_type_id',
        'product_characteristic_id',
        'updated_at',
        'created_at',
    ];

    public function type()
    {
        return $this->hasOne(
            'App\productType',
            'id',
            'product_type_id'
        );
    }

    public function charactetistics()
    {
        return $this->hasMany(
            'App\productCharacteristic',
            'id',
            'product_characteristic_id'
        );
    }
}
