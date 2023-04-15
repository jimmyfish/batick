<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $mapped = [
        'is_closed' => 'boolean',
    ];

    public function symbol()
    {
        return $this->belongsTo(Symbol::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wereOpen()
    {
        return $this->is_closed === false;
    }
}
