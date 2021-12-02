<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Переименование столбца в таблице courses_activities
 *
 * courses_id -> course_id
 */
class ColumnNameChangeCoursesIdToTableCoursesActivities extends Migration
{
    /**
     * Устанавливаем изменения
     */
    public function up()
    {
        Schema::table('courses_activities', function (Blueprint $table) {
            $table->renameColumn('courses_id', 'course_id');
        });
    }

    /**
     * Откат изменений
     */
    public function down()
    {
        Schema::table('courses_activities', function (Blueprint $table) {
            $table->renameColumn('course_id', 'courses_id');
        });
    }
}
