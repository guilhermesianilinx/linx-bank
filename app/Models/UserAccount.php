<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    const ACCOUNT_ENABLED = 1;
    const INITIAL_BALANCE = 0;

    protected $table = 'users_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'account_type_id',
        'balance',
        'enabled',
        'disabled_at',
    ];

    public static $createRules = [
        'user_id' => 'required',
        'account_type_id' => 'required',
    ];
}
