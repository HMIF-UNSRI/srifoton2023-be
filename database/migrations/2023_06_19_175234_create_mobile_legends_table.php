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
        Schema::create('mobile_legends', function (Blueprint $table) {
            // Data
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('team_name')->unique();
            $table->string('email')->unique();

            // Anggota 1
            $table->string('name1');
            $table->string('nim1');
            $table->string('college1');
            $table->string('phone_number1');
            $table->string('instagram1');
            $table->string('id_mole1');
            $table->string('id_card1');
            // Anggota 2
            $table->string('name2');
            $table->string('nim2');
            $table->string('college2');
            $table->string('phone_number2');
            $table->string('instagram2');
            $table->string('id_mole2');
            $table->string('id_card2');
            // Anggota 3
            $table->string('name3');
            $table->string('nim3');
            $table->string('college3');
            $table->string('phone_number3');
            $table->string('instagram3');
            $table->string('id_mole3');
            $table->string('id_card3');
            // Anggota 4
            $table->string('name4');
            $table->string('nim4');
            $table->string('college4');
            $table->string('phone_number4');
            $table->string('instagram4');
            $table->string('id_mole4');
            $table->string('id_card4');
            // Anggota 5
            $table->string('name5');
            $table->string('nim5');
            $table->string('college5');
            $table->string('phone_number5');
            $table->string('instagram5');
            $table->string('id_mole5');
            $table->string('id_card5');
            // Anggota 6
            $table->string('name6')->nullable();
            $table->string('nim6')->nullable();
            $table->string('college6')->nullable();
            $table->string('phone_number6')->nullable();
            $table->string('instagram6')->nullable();
            $table->string('id_mole6')->nullable();
            $table->string('id_card6')->nullable();

            // Payment
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
        Schema::dropIfExists('mobile_legends');
    }
};
