<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'amount_paid',
        'payment_method',
        'payment_status',
        'payment_date',
    ];

    protected function casts(): array
    {
        return [
            'payment_date' => 'datetime',
        ];
    }

    /**
     * Relasi Inverse: Pembayaran merujuk ke satu transaksi.
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}