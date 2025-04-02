<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('phone_id')->nullable()->after('email'); // Tambahkan kolom phone_id
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('set null'); // Relasi ke phones
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['phone_id']);
            $table->dropColumn('phone_id');
        });
    }
};

