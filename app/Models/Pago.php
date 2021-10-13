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

    protected $dates = [
        'created_at',
        'fechaVencimiento',
        'fechaPago',
    ];

    // protected $dateFormat = 'Y-m-d H:00';

    // protected $casts = [
    //     'created_at' => 'datetime',
    //     'fechaVencimiento' => 'datetime:d-m-Y H:00',
    //     'fechaPago' => 'datetime:d-m-Y H:00',
    // ];


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
