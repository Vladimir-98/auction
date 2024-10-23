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
        Schema::create('call_records', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('card_id')
                ->nullable();

            $table->foreign('card_id')
                ->references('id')
                ->on('cards')
                ->onDelete('set null');

            $table->string('record')
                ->nullable()
                ->comment(__('fields.card.record'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_call_records');
    }
};
