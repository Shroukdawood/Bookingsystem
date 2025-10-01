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
        Schema::create('bookings', function (Blueprint $table) {
             $table->id();
             $table->string('username');
             $table->string('phone');
             $table->string('email');
             $table->time('booking_time');
             $table->date('booking_date');
             $table->integer('guests');
             $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
             $table->enum('table_preference', ['indoor', 'outdoor', 'window'])->nullable();
             $table->text('special_requests')->nullable();
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
