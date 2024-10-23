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
        Schema::create('types', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->comment(__('fields.type.name'));

            $table->string('icon')
                ->nullable()
                ->comment(__('fields.type.icon'));

            $table->boolean('visibility')
                ->default(0)
                ->comment(__('fields.type.visibility'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
