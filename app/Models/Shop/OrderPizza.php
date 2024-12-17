<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPizza extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'shop_order_pizzas';

    protected $fillable = [
        'quantity',
        'size',
        'choose',
        'properties',
        'unit_price',
    ];

    protected $casts = [
        'properties' => 'json',
    ];

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function specialityGet(): Speciality | null
    {
        return Speciality::whereId($this->properties['speciality_id'])->get()->first();
    }
}
