<?php

namespace SimpleState\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Database\Factories\BalanceFactory;

class Balance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = 'wallet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'user_id',
        'created_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return BalanceFactory::new();
    }

    public function user()
    {
        return $this->setConnection('mysql')->belongsTo(User::class);
    }
}
