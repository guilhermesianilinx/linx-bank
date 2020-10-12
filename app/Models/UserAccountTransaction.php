<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountTransaction extends Model
{
    use HasFactory;

    protected $table = 'users_accounts_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_account_id',
        'transacted_amount',
    ];

    public static $createRules = [
        'user_id' => 'required',
        'user_account_id' => 'required',
        'transacted_amount' => 'required',
    ];
}
