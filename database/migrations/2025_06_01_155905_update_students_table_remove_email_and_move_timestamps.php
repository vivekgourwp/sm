<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentsTableRemoveEmailAndMoveTimestamps extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Remove the email column
            $table->dropColumn('email');

            // Drop existing timestamps
            $table->dropTimestamps();
        });

        // Re-add timestamps at the end
        Schema::table('students', function (Blueprint $table) {
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Re-add email column
            $table->string('email')->nullable();

            // Drop timestamps
            $table->dropTimestamps();
        });

        // Re-add timestamps
        Schema::table('students', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}
