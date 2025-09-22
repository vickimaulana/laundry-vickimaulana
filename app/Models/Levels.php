<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Levels extends Model
{
    use SoftDeletes;
    protected $fillable = ['level_name'];

    public function users(){
        return $this->hasMany(User::class, 'id_level');
    }
}
