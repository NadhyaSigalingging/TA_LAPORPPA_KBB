<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response', function (Blueprint $table) {
            $table->id();

            // complaint
            $table->unsignedBigInteger('complaint_id')->nullable();
            $table->foreign('complaint_id')
                  ->references('id')->on('complaint')
                  ->onDelete('cascade');

            // boleh kosong, diisi ketika petugas memberi tanggapan
            $table->date('response_date')->nullable();

            // isi tanggapan - boleh kosong
            $table->text('response')->nullable();

            // user/petugas yang memberi tanggapan
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('response');
    }
}
