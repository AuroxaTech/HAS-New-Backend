<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('service_name'); // Ensure this line exists
            $table->text('description');
            $table->decimal('pricing', 10, 2);
            $table->unsignedInteger('duration'); // Assuming this is an integer
            $table->string('start_time');
            $table->string('end_time');
            $table->string('location');
            $table->decimal('lat', 10, 7);
            $table->decimal('long', 10, 7);
            $table->text('additional_information')->nullable();
            $table->string('country');
            $table->string('city');
            $table->unsignedInteger('year_experience')->default(0);
            $table->string('cnic_front_pic')->nullable();
            $table->string('cnic_back_pic')->nullable();
            $table->string('certification')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
