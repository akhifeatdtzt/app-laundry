<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_id',
        'service_id',
        'weight',
        'price_per_kg',
        'total_price',
        'entry_date',
        'estimated_completion',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'weight' => 'decimal:2',
            'entry_date' => 'date',
            'estimated_completion' => 'date',
        ];
    }

    /**
     * Relasi Inverse: Transaksi dimiliki oleh satu pelanggan.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi Inverse: Transaksi menggunakan satu jenis layanan.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Relasi One to One: Satu transaksi memiliki satu catatan pembayaran.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}