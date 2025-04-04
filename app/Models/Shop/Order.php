<?php

namespace App\Models\Shop;

use App\Enums\OrderPriority;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'shop_orders';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'total_price',
        'status',
        'currency',
        'shipping_price',
        'shipping_method',
        'notes',
        'subtotal',
        'address_id',
        'shipping',
        'with_invoice',
        'cash_id',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'priority' => OrderPriority::class,
        'with_invoice' => 'boolean',
    ];

    /** @return MorphOne<OrderAddress> */
    public function address(): MorphOne
    {
        return $this->morphOne(OrderAddress::class, 'addressable');
    }

    /** @return BelongsTo<Customer,self> */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'shop_customer_id');
    }

    /** @return BelongsTo<User,self> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return HasMany<OrderItem> */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'shop_order_id');
    }

    /** @return HasMany<OrderPizza> */
    public function pizzas(): HasMany
    {
        return $this->hasMany(OrderPizza::class, 'shop_order_id');
    }

    /** @return HasMany<OrderItem> */
    public function theitems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'shop_order_id', 'item_id');
    }

    /** @return HasMany<Payment> */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function order_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function cash(): BelongsTo
    {
        return $this->belongsTo(Cash::class, 'cash_id');
    }

    public function getTotalItemsAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->qty * $item->unit_price;
        });
    }

    public function getTotalPizzasAttribute()
    {
        return $this->pizzas->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });
    }

    public function getTotalPaymentsAttribute()
    {
        return $this->payments->sum('amount');
    }

    public function getTotalOrderAttribute()
    {
        return $this->total_items + $this->total_pizzas + $this->shipping_price;
    }

    public function getCreatedAtTimeAttribute()
    {
        return $this->created_at ? $this->created_at->format('H:i') : null;
    }

    public function getRemainingTimeAttribute(): string
    {
        // Obtener los minutos directamente como entero
        $totalMinutes = DB::table('settings')
            ->where('group', 'minutes') // Ajusta según tu grupo
            ->value('payload') ?? 40; // Valor por defecto si no existe
        
        // Calcular tiempo restante
        $createdAt = Carbon::parse($this->created_at);
        $expiresAt = $createdAt->addMinutes($totalMinutes);
        $now = Carbon::now();
        
        if ($now >= $expiresAt) {
            return 'Expirado'; // Tiempo expirado
        }
        
        $remainingSeconds = $now->diffInSeconds($expiresAt);
        
        return sprintf('%02d:%02d', 
            intdiv($remainingSeconds, 60),  // Minutos
            $remainingSeconds % 60         // Segundos
        );
    }
}
