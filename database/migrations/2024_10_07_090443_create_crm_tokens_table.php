<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crm_tokens', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->nullable()
                ->comment(__('fields.crm.name'));

            $table->string('token')
                ->comment(__('fields.crm.token'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_tokens');
    }
};
