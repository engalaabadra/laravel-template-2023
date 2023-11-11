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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('reservation_id')->nullable();
            // $table->foreign('reservation_id')->references('id')->on('reservations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('wallet_id')->nullable();
            $table->foreign('wallet_id')->references('id')->on('wallets')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('transaction_id');
            $table->string('customer_id');
            $table->string('source');
            $table->text('status');
            $table->tinyInteger('active')->default(1);//0:inactive 1:active 
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
