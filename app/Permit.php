<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $fillable = ['user_id', 'date_permit', 'note', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}