<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('first_name')->nullable()->before('name');
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('last_name')->nullable()->after('middle_name');
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable()->after('middle_name');
            $table->date('date_of_birth')->nullable()->after('gender');

            
            
            $table->unsignedBigInteger('contact_id')->nullable()->after('id');
            // Foreign key constraint (assuming contacts.id is the primary key)
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['contact_id']);

            // Then drop the column
            $table->dropColumn('contact_id');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('last_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('first_name');
        });
    }

}
