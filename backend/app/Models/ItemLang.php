<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLang extends Model
{
  use HasFactory;

  protected $table = 'items_lang';

  protected $fillable = [
    'item_id',
    'language',
    'name',
    'description',
  ];

  public function item()
  {
    return $this->belongsTo(Item::class);
  }
}
