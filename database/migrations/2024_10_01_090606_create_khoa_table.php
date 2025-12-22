<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhoaTable extends Migration
{
    public function up()
    {
        Schema::create('khoa', function (Blueprint $table) {
            $table->string('makhoa')->primary();
            $table->string('tenkhoa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('khoa');
    }
}
