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
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->string('transaction_type')->nullable(); // e.g., CustomerPayBillOnline
            $table->string('trans_id')->unique(); // M-Pesa Transaction ID
            $table->string('trans_time'); // Transaction time (e.g., 20250423123045)
            $table->decimal('trans_amount', 10, 2); // Transaction amount
            $table->string('business_short_code'); // PayBill or Till Number
            $table->string('bill_ref_number')->nullable(); // Account number or reference
            $table->string('invoice_number')->nullable(); // Optional invoice number
            $table->decimal('org_account_balance', 10, 2)->nullable(); // Organization balance after transaction
            $table->string('third_party_trans_id')->nullable(); // Third-party transaction ID
            $table->string('msisdn'); // Customer phone number
            $table->string('first_name')->nullable(); // Customer first name
            $table->string('middle_name')->nullable(); // Customer middle name
            $table->string('last_name')->nullable(); // Customer last name
            $table->string('status')->default('pending'); // Transaction status (e.g., pending, completed, failed)
            $table->text('callback_response')->nullable(); // Full callback response for debugging
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_payments');
    }
};
