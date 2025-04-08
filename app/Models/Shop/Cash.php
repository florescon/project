<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Shop\Order;
use App\Models\Shop\Finance;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cash extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'cashes';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'initial',
        'comment',
        'user_id',
        'is_processed',
    ];

    protected $casts = [
        'is_processed' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'cash_id');
    }

    public function finances()
    {
        return $this->hasMany(Finance::class, 'cash_id');
    }

    public function getTotalOrdersAttribute()
    {
        return $this->orders->count();
    }

    public function getTotalOrdersPriceAttribute()
    {
        return $this->orders->sum(function ($item) {
            return $item->total_order;
        });
    }

   /**
     * Calcula el balance total de las finanzas asociadas
     * 
     * @return float Balance total (ingresos - egresos)
     */
    public function calculateBalance(): float
    {
        return $this->finances->reduce(function ($carry, $finance) {
            return $finance->is_income 
                ? $carry + $finance->qty 
                : $carry - $finance->qty;
        }, 0);
    }

    /**
     * Atributo calculado para acceder fácilmente al balance
     * 
     * @return float Balance total
     */
    public function getBalanceFinanceAttribute(): float
    {
        return $this->calculateBalance();
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($cash) {

            // Actualiza manualmente los registros relacionados en shop_orders
            if (!$cash->isForceDeleting()) {
                $cash->orders()->update(['cash_id' => null]);
                $cash->finances()->update(['cash_id' => null]);
            }
        });
    }    

    /** @return BelongsTo<User,self> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
