<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fechavencimiento',
        'status',
        'payment_type',
        'payment_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'fechavencimiento' => 'datetime'
    ];


    /**
     * Get the user that owns the Pago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
