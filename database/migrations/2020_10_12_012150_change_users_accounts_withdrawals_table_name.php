<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersAccountsWithdrawalsTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_accounts_withdrawals', function (Blueprint $table) {
            $table->integer('amount_withdrawn')->change();
            $table->renameColumn('amount_withdrawn', 'transacted_amount');
        });

        Schema::rename('users_accounts_withdrawals', 'users_accounts_transactions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('users_accounts_transactions', 'users_accounts_withdrawals');

        Schema::table('users_accounts_withdrawals', function (Blueprint $table) {
            $table->renameColumn('amount_withdrawn', 'transacted_amount');
            $table->unsignedInteger('amount_withdrawn')->change();
        });
    }
}
