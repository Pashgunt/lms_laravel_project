<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActivitiesText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_text', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id');
            $table->mediumText('title');
            $table->longText('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities_text', function (Blueprint $table) {
            $table->drop();
        });
    }
}
