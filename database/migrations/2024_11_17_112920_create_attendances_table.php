<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('event_name');
            $table->timestamp('time_in');
            $table->string('timein_photo')->nullable(); 
            $table->timestamp('time_out')->nullable();
            $table->string('timeout_photo')->nullable(); 
            $table->text('remarks')->nullable();
            $table->enum('status', ['on_time', 'late'])->default('on_time'); 
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
