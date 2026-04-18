<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('society')) {
            Schema::create('society', function (Blueprint $table) {
                $table->id();
                $table->string('nik')->unique()->comment('Nomor Induk Kependudukan');
                $table->string('name');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('photo')->nullable();
                $table->string('password');
                $table->string('phone_number');
                $table->text('address');
                $table->timestamps();

                // Index untuk performa query
                $table->index('nik');
                $table->index('username');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('society');
    }
};