<?php

use App\Enum\StatusPaymentEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->integer('value');
            $table->foreignId('user_id')->constrained();
            $table->string('correlationID');
            $table->string('comment')->nullable();
            $table->string('paymentLinkUrl');
            $table->longText('qrCodeImage');
            $table->string('status')->default(StatusPaymentEnum::PENDING->value);
            $table->string('message')->nullable();
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
