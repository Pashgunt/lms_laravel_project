<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCoursesTimestamp extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->timestamp('created_at')->change();
            $table->timestamp('deleted_at')->nullable()->change();
            $table->timestamp('updated_at')->nullable()->change();
        });
    }

    /**
     * Rollback the migrations.
     */
    public function down():void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->date('created_at')->change();
            $table->date('deleted_at')->nullable()->change();
            $table->date('updated_at')->nullable()->change();
        });
    }
}
