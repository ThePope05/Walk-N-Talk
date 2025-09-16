<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Queue extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function user() : HasOne
    {
        return $this->hasOne(User::class);
    }
}
