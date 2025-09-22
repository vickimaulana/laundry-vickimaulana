<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransOrders extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id_customer',
        'order_code',
        'order_date',
        'order_end_date',
        'order_status',
        'order_pay',
        'order_change',
        'total'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_customer', 'id');
    }

    public function details()
    {
        return $this->hasMany(TransOrderDetails::class, 'id_order');
    }

    public function pickup()
    {
        return $this->hasOne(TransLaundryPickup::class, 'id_order');
    }

    public function getStatusTextAttribute()
    {
        switch ($this->order_status) {
            case '0':
                return "New";
                break;

            default:
                return "Picked Up";
                break;
        }
    }
}
