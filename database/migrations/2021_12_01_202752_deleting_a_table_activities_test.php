<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Таблица избыточна. изменения реализации, нормализация БД
 */
class DeletingATableActivitiesTest extends Migration
{
    /**
     * Устанавливаем изменения
     */
    public function up(): void
    {
        Schema::dropIfExists('activities_test');
    }

    /**
     * Откат изменений
     */
    public function down(): void
    {
        Schema::create('activities_test', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longText('about');
            $table->longText('questions');
        });
    }
}
