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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->foreign('wallet_id')
                ->references('id')
                ->on('wallets')
                ->onDelete('cascade')->nullable();

            // $table->unsignedBigInteger('reservation_id');
            // $table->foreign('reservation_id')
            //     ->references('id')
            //     ->on('reservations')
            //     ->onDelete('cascade')->nullable();
            
            $table->unsignedBigInteger('payment_log_id');
            $table->foreign('payment_log_id')
                ->references('id')
                ->on('payment_logs')
                ->onDelete('cascade')->nullable();
                    
                
            $table->string('name')->nullable();
            $table->float('original_value')->nullable();
            $table->float('balance_before')->nullable();
            $table->float('balance_after')->nullable();
            
            $table->enum('type',['-1','1'])->nullable();
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
        Schema::dropIfExists('movements_calls');
    }
};
