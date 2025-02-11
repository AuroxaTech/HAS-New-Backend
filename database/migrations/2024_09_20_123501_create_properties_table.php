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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('city');
            $table->decimal('amount', 10, 2);
            $table->string('address');
            $table->decimal('lat', 10, 8);
            $table->decimal('long', 11, 8);
            $table->string('area_range');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->text('description');
            $table->string('electricity_bill_image');
            $table->string('property_type');
            $table->string('property_sub_type');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
