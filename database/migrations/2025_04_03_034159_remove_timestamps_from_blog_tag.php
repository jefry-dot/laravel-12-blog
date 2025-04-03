<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blog_tag', function (Blueprint $table) {
            $table->dropTimestamps(); // Hapus timestamps
        });
    }

    public function down()
    {
        Schema::table('blog_tag', function (Blueprint $table) {
            $table->timestamps(); // Tambahkan kembali jika rollback
        });
    }
};
