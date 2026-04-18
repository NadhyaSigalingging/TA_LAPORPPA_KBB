<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('response', function (Blueprint $table) {
            $table->enum('status', ['process', 'finished', 'rejected'])
                  ->default('process')
                  ->after('response');
        });
    }

    public function down()
    {
        Schema::table('response', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
