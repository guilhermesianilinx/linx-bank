<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAccountTypeOnUsersAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_accounts', function (Blueprint $table) {
            $table->renameColumn('account_type', 'account_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_accounts', function (Blueprint $table) {
            $table->renameColumn('account_type_id', 'account_type');
        });
    }
}
