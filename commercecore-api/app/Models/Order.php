<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'postcode',
        'warranty'
    ];

    public function setFirstNameAttribute( $name )
    {
        $this->attributes['first_name'] = ucfirst( strtolower( $name ));
    }
    
    public function setLastNameAttribute( $name )
    {
        $this->attributes['last_name'] = ucfirst( strtolower( $name ));
    }
}
