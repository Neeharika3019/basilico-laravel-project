<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemApiController extends Controller
{
    public function index()
    {
        return response()->json(
            MenuItem::with(['category', 'tags'])->get()
        );
    }

    public function show($id)
    {
        $item = MenuItem::with(['category', 'tags'])->find($id);

        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($item);
    }

    public function store(Request $request)
    {
        $item = MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        if ($request->tags) {
            $item->tags()->attach($request->tags);
        }

        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = MenuItem::find($id);

        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        if ($request->tags) {
            $item->tags()->sync($request->tags);
        }

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = MenuItem::find($id);

        if (!$item) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}