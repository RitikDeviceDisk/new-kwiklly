<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CartItemUpdatedNotification;

class VendorCartController extends Controller
{
    // List all cart items related to this vendor
    public function index()
    {
        $vendorId = auth()->id(); // assuming vendor is authenticated
        $cartItems = CartItem::where('vendor_id', $vendorId)->with('user')->get();
        return view('vendorpanel.cart', compact('cartItems','vendorId'));
    }

    // Update quantity or remove cart item
    public function update(Request $request)
    {
        $id = $request->vendor_id;
        $cartItem = CartItem::where('vendor_id', $id)->findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Notify user
        $user = $cartItem->user;
        Notification::send($user, new CartItemUpdatedNotification($cartItem));

        return back()->with('success', 'Cart item updated and user notified.');
    }

    // Delete cart item
    public function destroy($id)
    {
        $cartItem = CartItem::where('vendor_id', auth()->id())->findOrFail($id);
        $user = $cartItem->user;

        $cartItem->delete();

        // Notify user
        Notification::send($user, new CartItemUpdatedNotification(null, true));

        return back()->with('success', 'Cart item removed and user notified.');
    }
}
