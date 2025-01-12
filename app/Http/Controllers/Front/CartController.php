<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Darryldecode\Cart\Facades\CartFacade as Cart;

use Illuminate\Http\Request;

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
    public function add(string $id)
    {

        //get product where id
        $product = Products::where('id',$id)->first();

        
        // Add item to the cart
        Cart::add([
            'id' =>   $product->id, 
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->qty,
        ]);

        return redirect()->route('cart.list')->with('success', 'Item added to cart!');

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
