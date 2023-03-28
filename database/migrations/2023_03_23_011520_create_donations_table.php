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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('date');
            $table->string('donation_category')->default('Infak / Sedekah');
            $table->boolean('is_money')->default(true);
            $table->string('account')->default('cash');
            $table->bigInteger('money')->nullable();
            $table->string('goods')->nullable();
            $table->string('goods_qty')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('dataentry_id');
            $table->string('dataentry_name');
            $table->string('team')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
