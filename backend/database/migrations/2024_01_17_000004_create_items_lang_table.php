<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('items_lang', function (Blueprint $table) {
      $table->id();
      $table->foreignId('item_id')->constrained()->onDelete('cascade');
      $table->string('language', 5); // 'en', 'ru', etc.
      $table->string('name');
      $table->text('description');
      $table->timestamps();

      $table->unique(['item_id', 'language']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('items_lang');
  }
};
