<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
  public function index(Request $request)
  {
    $language = $request->get('lang', 'en');

    $items = Item::with(['user', 'translations' => function ($query) use ($language) {
      $query->where('language', $language);
    }])->latest()->get();

    return response()->json($items);
  }

  public function myItems(Request $request)
  {
    $language = $request->get('lang', 'en');

    $items = Item::where('user_id', $request->user()->id)
      ->with(['translations' => function ($query) use ($language) {
        $query->where('language', $language);
      }])
      ->latest()
      ->get();

    return response()->json($items);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric|min:0',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('items', 'public');
    }

    $item = Item::create([
      'user_id' => $request->user()->id,
      'price' => $request->price,
      'image' => $imagePath,
    ]);

    // Store translation (default to English)
    ItemLang::create([
      'item_id' => $item->id,
      'language' => 'en',
      'name' => $request->name,
      'description' => $request->description,
    ]);

    return response()->json($item->load('translations'), 201);
  }

  public function show($id, Request $request)
  {
    $language = $request->get('lang', 'en');

    $item = Item::with(['user', 'translations' => function ($query) use ($language) {
      $query->where('language', $language);
    }])->findOrFail($id);

    return response()->json($item);
  }

  public function update(Request $request, $id)
  {
    $item = Item::findOrFail($id);

    if ($item->user_id !== $request->user()->id) {
      return response()->json(['message' => 'Unauthorized'], 403);
    }

    $request->validate([
      'name' => 'sometimes|required|string|max:255',
      'description' => 'sometimes|required|string',
      'price' => 'sometimes|required|numeric|min:0',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
      // Delete old image
      if ($item->image) {
        Storage::disk('public')->delete($item->image);
      }
      $item->image = $request->file('image')->store('items', 'public');
    }

    if ($request->has('price')) {
      $item->price = $request->price;
    }

    $item->save();

    // Update translation
    if ($request->has('name') || $request->has('description')) {
      $translation = $item->translations()->where('language', 'en')->first();
      if ($translation) {
        $translation->update([
          'name' => $request->get('name', $translation->name),
          'description' => $request->get('description', $translation->description),
        ]);
      }
    }

    return response()->json($item->load('translations'));
  }

  public function destroy($id, Request $request)
  {
    $item = Item::findOrFail($id);

    if ($item->user_id !== $request->user()->id) {
      return response()->json(['message' => 'Unauthorized'], 403);
    }

    // Check if item is in any trades
    if ($item->tradesFrom()->exists() || $item->tradesTo()->exists()) {
      return response()->json([
        'message' => 'Cannot delete item that is part of a trade'
      ], 422);
    }

    // Delete image
    if ($item->image) {
      Storage::disk('public')->delete($item->image);
    }

    $item->delete();

    return response()->json(['message' => 'Item deleted successfully']);
  }
}
