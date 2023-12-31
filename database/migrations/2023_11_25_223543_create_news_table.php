<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->unsignedBigInteger('channel_link_id');
            $table->string('title');
            $table->string('link');
            $table->text('description');
            $table->date('publish_at');
            $table->string('image')->nullable();
            $table->foreign('channel_link_id')->references('id')->on('channel_links');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
