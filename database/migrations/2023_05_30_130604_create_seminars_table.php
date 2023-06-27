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
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nim');
            $table->string('college');
            $table->string('phone_number');
            $table->string('type');
            $table->string('proof');
            $table->string('payment_method');
            $table->string('ticket_code')->nullable()->unique();
            $table->string('ticket_file')->nullable();
            $table->boolean('isVerified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }
};
