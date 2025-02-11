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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('landlordName');
            $table->string('landlordAddress');
            $table->string('landlordPhone');
            $table->string('tenantName');
            $table->string('tenantAddress');
            $table->string('tenantPhone');
            $table->string('tenantEmail');
            $table->integer('occupants');
            $table->string('premisesAddress');
            $table->string('propertyType');
            $table->date('leaseStartDate');
            $table->date('leaseEndDate');
            $table->string('leaseType');
            $table->decimal('rentAmount', 10, 2);
            $table->date('rentDueDate');
            $table->string('rentPaymentMethod');
            $table->decimal('securityDepositAmount', 10, 2);
            $table->string('includedUtilities')->nullable();
            $table->text('tenantResponsibilities')->nullable();
            $table->string('emergencyContactName');
            $table->string('emergencyContactPhone');
            $table->string('emergencyContactAddress');
            $table->string('buildingSuperintendentName')->nullable();
            $table->string('buildingSuperintendentAddress')->nullable();
            $table->string('buildingSuperintendentPhone')->nullable();
            $table->integer('rentIncreaseNoticePeriod')->nullable();
            $table->integer('noticePeriodForTermination')->nullable();
            $table->decimal('latePaymentFee', 8, 2)->nullable();
            $table->string('rentalIncentives')->nullable();
            $table->text('additionalTerms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
