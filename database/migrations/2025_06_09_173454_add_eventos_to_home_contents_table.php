<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventosToHomeContentsTable extends Migration
{
    public function up()
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->string('eventos')->default('0')->after('estados');
        });
    }

    public function down()
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->dropColumn('eventos');
        });
    }
}
