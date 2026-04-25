<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Special;

class OrderOnlineController extends Controller
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('registration')
                ->with('error', 'Please create an account first before ordering online.');
        }

        $specials = Special::all();

        return view('order-online', compact('specials'));
    }

    public function startOrder($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('registration')
                ->with('error', 'Please create an account first before ordering online.');
        }

        $item = Special::find($id);

        if (!$item) {
            return redirect()->route('order.online')->with('error', 'Item not found.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            $cart[$item->id]++;
        } else {
            $cart[$item->id] = 1;
        }

        session()->put('cart', $cart);

        return redirect()->route('order.online')->with('success', $item->dish_name . ' added to cart! Check Order Online to continue.');
    }

    public function addToCart(Request $request)
    {
        if (!session()->has('user_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Please create an account first before ordering online.'
            ], 401);
        }

        $request->validate([
            'id' => 'required|exists:specials,id'
        ]);

        $cart = session()->get('cart', []);
        $item = Special::find($request->id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found.'
            ], 404);
        }

        if (isset($cart[$item->id])) {
            $cart[$item->id]++;
        } else {
            $cart[$item->id] = 1;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => $item->dish_name . ' added to cart successfully. Continue in Order Online.'
        ]);
    }

    public function updateCart(Request $request)
    {
        if (!$request->has('qty')) {
            return back()->with('error', 'Invalid cart update');
        }

        $cart = session()->get('cart', []);

        foreach ($request->qty as $id => $qty) {
            $qty = max(0, (int) $qty);

            if ($qty == 0) {
                unset($cart[$id]);
            } else {
                $cart[$id] = $qty;
            }
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated successfully!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        $request->validate([
            'method' => 'required|in:delivery,pickup',
            'address' => 'nullable|string'
        ]);

        if ($request->method === 'delivery' && empty($request->address)) {
            return back()->with('error', 'Address is required for delivery');
        }

        session()->forget('cart');

        return back()->with('success', 'Order placed successfully!');
    }
}