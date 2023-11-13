<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('main_lang')->default(localLang());
            $table->unsignedBigInteger('translate_id')->nullable();
            $table->foreign('translate_id')->references('id')->on('addresses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('line_1');
            $table->string('line_2');
            $table->string('line_3');
            $table->string('zipcode')->nullable();
            $table->decimal('longitute');
            $table->decimal('latitude');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('address_type_id');
            $table->foreign('address_type_id')->references('id')->on('address_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            $table->string('owner_type');
            $table->string('email');
            $table->string('phone_number');
            $table->text('url');

            $table->tinyInteger('active')->default(1);//0:inactive 1:active 
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
