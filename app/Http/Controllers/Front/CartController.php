<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Darryldecode\Cart\Facades\CartFacade as Cart;


class CartController extends Controller
{
    // Show the cart view
    public function index()
    {
        // Get all items in the cart
        $items = Cart::getContent();

        //check cart items of empty


        // Return the cart view with the items
        return view('front-end.cart.list', compact('items'));
        
    }

    // Add an item to the cart
    public function add(Request $request)
    {
        
        // Add item to the cart
        Cart::add([
            'id' => $request->id, 
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $request->image, 
                'size' => $request->size, 
                'color' => $request->color,
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    // Update the quantity of an item in the cart
    public function update(Request $request, $id)
    {
        // Validate the quantity
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update the item quantity in the cart
        Cart::update($id, [
            'quantity' => [
                'relative' => false, 
                'value' => $request->quantity,
            ],
        ]);

        // Redirect back with success message
        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    // Remove an item from the cart
    public function remove($id)
    {
        // Remove the item from the cart
        Cart::remove($id);

        // Redirect back with success message
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    // Clear the entire cart
    public function clear()
    {
        // Clear all items from the cart
        Cart::clear();

        // Redirect back with success message
        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
