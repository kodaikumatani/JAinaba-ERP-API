<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'user_id',
        'store_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function fetchDailyAccounts()
    {
        return $this
            ->select('date')
            ->selectRaw('sum(price * quantity) as amount')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->withCasts([
                'amount' => 'integer',
            ])->get();
    }
}
