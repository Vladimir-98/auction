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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->comment(__('fields.card.name'));

            $table->longText('desc')
                ->nullable()
                ->comment(__('fields.card.desc'));

            $table->string('phone')
                ->nullable()
                ->comment(__('fields.card.phone'));

            $table->unsignedBigInteger('budget_min')
                ->nullable()
                ->comment(__('fields.card.budget_min'));

            $table->unsignedBigInteger('budget_max')
                ->nullable()
                ->comment(__('fields.card.budget_max'));

            $table->unsignedBigInteger('lead_price')
                ->nullable()
                ->comment(__('fields.card.lead_price'));

            $table->unsignedBigInteger('status_id')
                ->nullable()
                ->comment(__('fields.card.status_id'));

            $table->foreign('status_id')
                ->references('id')
                ->on('card_statuses')
                ->onDelete('set null');

            $table->unsignedBigInteger('crm_id')
                ->nullable()
                ->comment(__('fields.card.crm_id'));

            $table->string('crm_url')
                ->nullable()
                ->comment(__('fields.card.crm_url'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
