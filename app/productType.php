<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productType extends Model
{
    protected $table = 'product_type';
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
            'product_type_id',
            'id'
        );
    }
}
