<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransLaundryPickup extends Model
{
    protected $fillable = ['id_order', 'id_customer', 'pickup_date'];

    public function order()
    {
        return $this->belongsTo(TransOrders::class, 'id_order', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_customer', 'id');
    }
}
