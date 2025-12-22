<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLophocTable extends Migration
{
    public function up()
    {
        Schema::create('lophoc', function (Blueprint $table) {
            $table->increments('malop');
            $table->string('tenlop');
            $table->string('makhoa');
            $table->foreign('makhoa')->references('makhoa')->on('khoa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lophoc');
    }
}
