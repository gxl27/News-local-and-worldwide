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
        Schema::create('normalizers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_link_id');
            $table->foreign('channel_link_id')->references('id')->on('channel_links')->onDelete('cascade');
            $table->string('root_normalizer');
            $table->string('title_normalizer');
            $table->string('description_normalizer');
            $table->string('link_normalizer');
            $table->string('pub_date_normalizer');
            $table->string('guid_normalizer');
            $table->string('image_normalizer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normalizers');
    }
};
