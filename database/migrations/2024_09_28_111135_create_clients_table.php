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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('telegram_id')
                ->comment(__('fields.client.telegram_id'));

            $table->string('first_name')
                ->nullable()
                ->comment(__('fields.client.first_name'));

            $table->string('last_name')
                ->nullable()
                ->comment(__('fields.client.last_name'));

            $table->string('username')
                ->nullable()
                ->comment(__('fields.client.username'));

            $table->string('language_code')
                ->nullable()
                ->comment(__('fields.client.language_code'));

            $table->boolean('allows_write_to_pm')
                ->default(false)
                ->comment(__('fields.client.allows_write_to_pm'));

            $table->unsignedBigInteger('client_type_id')
                ->nullable()
                ->comment(__('fields.client.type'));

            $table->foreign('client_type_id')
                ->references('id')
                ->on('client_types')
                ->onDelete('set null');

            $table->unsignedBigInteger('status_id')
                ->nullable()
                ->comment(__('fields.client.status_id'));

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
