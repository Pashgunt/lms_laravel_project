<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NormalizeActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('text');
            $table->renameColumn('activity_type_id','type_id');
            $table->dropColumn('activity_title');
            $table->dropColumn('link');
            $table->integer('content_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->longText('text');
            $table->renameColumn('type_id', 'activity_type_id');
            $table->text('activity_title');
            $table->string('link');
            $table->dropColumn('content_id');
            $table->dropTimestamps();
        });
    }
}
