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
        Schema::create('babas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('weight');
            $table->string('price');
            $table->string('date');
            $table->integer('customer_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('babas');
    }
};
