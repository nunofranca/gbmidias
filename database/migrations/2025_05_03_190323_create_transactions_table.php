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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();            
            $table->integer('sale_id')->unsigned();
            $table->integer('value');
            $table->string('correlationID');
            $table->string('comment')->nullable();
            $table->string('paymentLinkUrl');
            $table->string('qrCodeImage');
            $table->string('status');
            $table->softDeletesTz();
            $table->timestampsTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
