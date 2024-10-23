<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('replenishments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')
                ->nullable()
                ->comment(__('fields.replenishment.client_id'));

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('set null');

            $table->decimal('amount', 10, 2)
                ->nullable()
                ->comment(__('fields.replenishment.amount'));

            $table->string('payment_method')
                ->nullable()
                ->comment(__('fields.replenishment.payment_method'));

            $table->json('metadata')->nullable()
                ->nullable()
                ->comment(__('fields.replenishment.metadata'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replenishments');
    }
};
