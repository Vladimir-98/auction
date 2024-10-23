<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')
                ->nullable()
                ->comment(__('fields.deduction.client_id'));

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('set null');

            $table->unsignedBigInteger('card_id')
                ->nullable()
                ->comment(__('fields.deduction.card_id'));

            $table->foreign('card_id')
                ->references('id')
                ->on('cards')
                ->onDelete('set null');

            $table->decimal('amount', 10, 2)
                ->nullable()
                ->comment(__('fields.deduction.amount'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deductions');
    }
};
