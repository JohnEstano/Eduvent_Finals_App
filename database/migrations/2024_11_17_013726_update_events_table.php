<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('status')->nullable(); // Add the 'status' column
            $table->string('requirement')->nullable(); // Add the 'requirement' column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status'); // Drop the 'status' column
            $table->dropColumn('requirement'); // Drop the 'requirement' column
        });
    }
};
