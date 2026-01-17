<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'price',
    'image',
  ];

  protected $casts = [
    'price' => 'decimal:2',
  ];

  protected $with = ['translations'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function translations()
  {
    return $this->hasMany(ItemLang::class);
  }

  public function translation($language = 'en')
  {
    return $this->translations()->where('language', $language)->first();
  }

  public function tradesFrom()
  {
    return $this->hasMany(Trade::class, 'item_from_id');
  }

  public function tradesTo()
  {
    return $this->hasMany(Trade::class, 'item_to_id');
  }
}
