<?php

namespace Bithoven\Dummy\Http\Controllers;

use App\Http\Controllers\Controller;
use Bithoven\Dummy\Models\DummyItem;
use Illuminate\Http\Request;

class DummyController extends Controller
{
    public function index()
    {
        $items = DummyItem::orderBy('order')->get();
        
        return view('dummy::index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'order' => 'required|integer|min:0',
        ]);

        $item = DummyItem::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dummy item created successfully',
            'item' => $item,
        ]);
    }

    public function update(Request $request, DummyItem $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'order' => 'required|integer|min:0',
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dummy item updated successfully',
            'item' => $item,
        ]);
    }

    public function destroy(DummyItem $item)
    {
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dummy item deleted successfully',
        ]);
    }
}
