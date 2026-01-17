<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('trades', function (Blueprint $table) {
      $table->id();
      $table->foreignId('item_from_id')->constrained('items')->onDelete('cascade');
      $table->foreignId('item_to_id')->constrained('items')->onDelete('cascade');
      $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('trades');
  }
};
