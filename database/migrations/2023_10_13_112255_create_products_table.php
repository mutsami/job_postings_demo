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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('details');
            $table->string('industry'); // Assuming this is a string column
            $table->string('rate'); // Define a decimal column for currency
            $table->string('phone');
            $table->string('user_id');
            $table->string('new_field');

            
            // The 'price' column stores currency values with a precision of 10 and a scale of 2.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
