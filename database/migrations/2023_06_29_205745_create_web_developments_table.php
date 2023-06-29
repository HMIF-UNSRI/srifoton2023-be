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
        Schema::create('web_developments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('team_name')->unique();
            $table->string('email')->unique();
            $table->string('college');
            // Anggota 1
            $table->string('name1');
            $table->string('nim1');
            $table->string('phone_number1');
            $table->string('instagram1');
            $table->string('id_card1');
            // Anggota 2
            $table->string('name2')->nullable();
            $table->string('nim2')->nullable();
            $table->string('phone_number2')->nullable();
            $table->string('instagram2')->nullable();
            $table->string('id_card2')->nullable();
            // Anggota 3
            $table->string('name3')->nullable();
            $table->string('nim3')->nullable();
            $table->string('phone_number3')->nullable();
            $table->string('instagram3')->nullable();
            $table->string('id_card3')->nullable();
            // Payment Method
            $table->string('submission')->nullable();
            $table->string('proof');
            $table->string('payment_method');
            $table->boolean('isVerified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_developments');
    }
};
