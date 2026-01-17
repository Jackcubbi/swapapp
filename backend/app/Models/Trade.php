<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
  use HasFactory;

  protected $fillable = [
    'item_from_id',
    'item_to_id',
    'status',
  ];

  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];

  public function itemFrom()
  {
    return $this->belongsTo(Item::class, 'item_from_id');
  }

  public function itemTo()
  {
    return $this->belongsTo(Item::class, 'item_to_id');
  }
}
