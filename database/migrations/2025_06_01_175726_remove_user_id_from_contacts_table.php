<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserIdFromContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Drop foreign key first (if exists)
            if (Schema::hasColumn('contacts', 'user_id')) {
                $table->dropForeign(['user_id']); // only if it's a foreign key
                $table->dropColumn('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();

            // Add foreign key again if needed
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
}