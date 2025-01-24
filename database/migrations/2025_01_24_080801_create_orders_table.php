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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->string('discount_Code')->nullable()->default('0');
            $table->string('discount_amount', 25)->default('0');
            $table->integer('shipping_id')->nullable();
            $table->string('shipping_amount', 25)->default('0');
            $table->string('total_amount', 25)->default('0');
            $table->string('payment_method', 25)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = pending
1= inprogress
2= delivered
3= completed
4= cancelled');
            $table->tinyInteger('is_delete')->default(0);
            $table->tinyInteger('is_payment')->default(0);
            $table->text('payment_data')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
