<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'qty',
        'comment',
        'is_income',
        'cash_id',
    ];

    protected $casts = [
        'is_income' => 'boolean',
    ];

    public function cash(): BelongsTo
    {
        return $this->belongsTo(Cash::class, 'cash_id');
    }
}
