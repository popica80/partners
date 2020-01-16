<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
