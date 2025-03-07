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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('agent_code');
            $table->string('client_name');
            $table->string('address_name');
            $table->string('contact', 50);
            $table->string('payment_term')->nullable();
            $table->string('payment_type')->nullable();
            $table->text('discount_deals')->nullable();
            $table->text('tie_up_pharmacy')->nullable();
            $table->text('rebates_given')->nullable();
            $table->date('clinic_date')->nullable();
            $table->date('deliver_date')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('sketch_map')->nullable();
            $table->string('prepared_by');
            $table->text('prepared_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
