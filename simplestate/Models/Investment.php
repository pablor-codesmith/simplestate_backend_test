<?php

namespace SimpleState\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Database\Factories\InvestmentFactory;
use Illuminate\Database\Eloquent\Builder;
use SimpleState\Enums\InvestmentStatusEnum;

class Investment extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'status',
        'user_id',
        'project_id',
        'transaction_id',
        'created_at'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'status' => InvestmentStatusEnum::class
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return InvestmentFactory::new();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Scope a query to only include owner jobs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserInvestments(Builder $query){
        return $query->selectRaw('
                            users.first_name AS `Nombre`,
                            COUNT(investments.id) AS `Cantidad`,
                            SUM(investments.amount) AS `Suma`'
            )
            ->join('users', 'users.id', '=', 'investments.user_id')
            ->groupBy('users.id');
    }
}
