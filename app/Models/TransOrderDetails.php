<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransOrderDetails extends Model
{
    protected $fillable = ['id_order', 'id_service', 'qty', 'subtotal', 'notes'];

    public function order()
    {
        return $this->belongsTo(TransOrders::class, 'id_order', 'id');
    }

    public function service()
    {
        return $this->belongsTo(TypeOfServices::class, 'id_service', 'id');
    }
}
