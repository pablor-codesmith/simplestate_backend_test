<?php

namespace SimpleState\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Database\Factories\TransactionFactory;
use SimpleState\Enums\TransactionStatusEnum;

class Transaction extends Model
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
        'status',
        'user_id',
        'operation_id',
        'created_at',
        'debin_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'status' => TransactionStatusEnum::class
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return TransactionFactory::new();
    }

    public function user(){
        return $this->setConnection('mysql')->belongsTo(User::class);
    }

    public function operation(){
        return $this->belongsTo(Operation::class);
    }
}
