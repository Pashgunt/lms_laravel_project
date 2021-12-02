<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesActivitiesTable extends Migration
{
    /**
     * Устанавливаем изменения
     */
    public function up(): void
    {
        Schema::create('courses_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courses_id');
            $table->unsignedBigInteger('activity_id');
            $table->integer('priority');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('courses_id')->references('id')->on('courses');
        });
    }

    /**
     * Откат изменений
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_activities');
    }
}
