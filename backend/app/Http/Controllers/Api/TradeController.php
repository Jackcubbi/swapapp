<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
  public function index(Request $request)
  {
    $trades = Trade::with(['itemFrom.translations', 'itemTo.translations', 'itemFrom.user', 'itemTo.user'])
      ->where(function ($query) use ($request) {
        $query->whereHas('itemFrom', function ($q) use ($request) {
          $q->where('user_id', $request->user()->id);
        })->orWhereHas('itemTo', function ($q) use ($request) {
          $q->where('user_id', $request->user()->id);
        });
      })
      ->latest()
      ->get();

    return response()->json($trades);
  }

  public function store(Request $request)
  {
    $request->validate([
      'item_from_id' => 'required|exists:items,id',
      'item_to_id' => 'required|exists:items,id',
    ]);

    // Verify that item_from belongs to the authenticated user
    $itemFrom = \App\Models\Item::findOrFail($request->item_from_id);
    if ($itemFrom->user_id !== $request->user()->id) {
      return response()->json([
        'message' => 'You can only trade your own items'
      ], 403);
    }

    $trade = Trade::create([
      'item_from_id' => $request->item_from_id,
      'item_to_id' => $request->item_to_id,
      'status' => 'pending',
    ]);

    return response()->json($trade->load(['itemFrom.translations', 'itemTo.translations']), 201);
  }
}
