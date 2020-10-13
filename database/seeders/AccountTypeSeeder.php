<?php

namespace Database\Seeders;

use App\Models\UserAccountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts_types')->insert([
            'id' => 1,
            'name' => 'Poupança',
        ]);
        DB::table('accounts_types')->insert([
            'id' => 2,
            'name' => 'Conta corrente',
        ]);
    }
}
