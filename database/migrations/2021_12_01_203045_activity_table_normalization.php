<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActivityTableNormalization extends Migration
{
    /**
     * Устанавливаем изменения
     */
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->integer('id')->change();
            $table->renameColumn('type_id', 'activity_type_id');
            $table->dropColumn('course_id', 'content_id', 'priority');
            $table->after('id', function ($table) {
                $table->string('name');
            });
        });
        Schema::table('activities_type', function (Blueprint $table) {
            $table->integer('id')->change();
        });
        Schema::table('activities', function (Blueprint $table) {
            $table->after('activity_type_id', function ($table) {
                $table->json('additional');
            });
            $table->foreign('activity_type_id')->references('id')->on('activities_type');
        });
    }

    /**
     * Откат изменений
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
            $table->renameColumn('activity_type_id', 'type_id');
            $table->integer('course_id');
            $table->integer('content_id');
            $table->integer('priority');
            $table->dropForeign('activities_type_activity_type_id_foreign');
        });
    }
}
