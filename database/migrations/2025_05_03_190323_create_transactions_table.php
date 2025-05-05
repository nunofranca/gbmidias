<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\StatusPaymentEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();            
            $table->integer('client_id')->unsigned();
            $table->integer('value');
            $table->string('correlationID');
            $table->string('comment')->nullable();
            $table->string('paymentLinkUrl');
            $table->string('qrCodeImage');
            $table->string('status')->default(StatusPaymentEnum::PENDING);
            $table->softDeletesTz();
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
