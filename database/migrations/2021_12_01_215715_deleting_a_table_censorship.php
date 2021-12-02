<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Таблица избыточна. изменения реализации, нормализация БД
 */
class DeletingATableCensorship extends Migration
{
    /**
     * Устанавливаем изменения
     */
    public function up(): void
    {
        Schema::dropIfExists('censorship');
    }

    /**
     * Откат изменений
     */
    public function down(): void
    {
        Schema::create('censorship', function (Blueprint $table) {
            $table->id();
            $table->integer('censorship');
        });
    }
}
