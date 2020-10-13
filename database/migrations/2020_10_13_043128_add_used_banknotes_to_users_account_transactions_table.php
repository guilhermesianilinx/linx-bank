<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsedBanknotesToUsersAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_accounts_transactions', function (Blueprint $table) {
            $table->json('used_banknotes')
                ->after('transacted_amount')
                ->nullable()
                ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_accounts_transactions', function (Blueprint $table) {
            $table->dropColumn('used_banknotes');
        });
    }
}
