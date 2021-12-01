<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Таблица избыточна. изменения реализации, нормализация БД
 */
class DeletingATableActivitiesText extends Migration
{
    /**
     * Устанавливаем изменения
     */
    public function up(): void
    {
        Schema::dropIfExists('activities_text');
    }

    /**
     * Откат изменений
     */
    public function down(): void
    {
        Schema::create('activities_text', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title');
            $table->longText('content');
        });
    }
}
