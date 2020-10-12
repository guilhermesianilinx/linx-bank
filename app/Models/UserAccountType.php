<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountType extends Model
{
    use HasFactory;

    const SAVINGS = 1;
    const CHECKING = 2;

    protected $table = 'accounts_types';
}
