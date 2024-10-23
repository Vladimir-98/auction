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
        Schema::create('filters', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->comment(__('fields.filter.name'));

            $table->string('title')
                ->nullable()
                ->comment(__('fields.filter.title'));

            $table->string('type')
                ->nullable()
                ->comment(__('fields.filter.type'));

            $table->boolean('dropDown')
                ->default(true)
                ->comment(__('fields.filter.dropDown'));

            $table->boolean('active')
                ->default(false)
                ->comment(__('fields.filter.active'));

            $table->string('items')
                ->nullable()
                ->comment(__('fields.filter.items'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filters');
    }
};
