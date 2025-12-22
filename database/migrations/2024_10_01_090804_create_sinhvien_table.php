<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinhvienTable extends Migration
{
    public function up()
    {
        Schema::create('sinhvien', function (Blueprint $table) {
            $table->string('mssv')->primary();
            $table->string('password');
            $table->string('hoten');
            $table->date('ngaysinh');
            $table->string('gioitinh');
            $table->unsignedInteger('malop');
            $table->foreign('malop')->references('malop')->on('lophoc');
            $table->string('makhoa');
            $table->foreign('makhoa')->references('makhoa')->on('khoa');
            $table->string('quequan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sinhvien');
    }
}
