<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Supaya tidak ada duplikasi tag dalam satu blog
            $table->unique(['blog_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_tag');
    }
};
