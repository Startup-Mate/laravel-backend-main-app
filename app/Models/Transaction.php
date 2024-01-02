<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['data'];

    public function users()
    {
        return $this->hasMany(UserTransaction::class, 'transaction_id');
    }
}
