<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speciality extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'shop_specialties';

    protected $fillable = [
        'name',
        'price_small',
        'price_medium',
        'price_large',
        'notes',
    ];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_specialty', 'shop_specialty_id', 'shop_ingredient_id')->where('for_pizza', true);
    }

    public function scopeSearch($query, string $search = '')
    {
        $query->where('name', 'like', "%{$search}%");
    }
}
