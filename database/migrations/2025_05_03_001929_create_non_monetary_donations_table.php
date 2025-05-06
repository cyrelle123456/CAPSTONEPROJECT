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
        Schema::create('non_monetary_donations', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('condition');
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone');
            $table->string('dropoff_location');
            $table->string('image')->nullable();
            $table->dateTime('preferred_time');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_monetary_donations');
    }
};
