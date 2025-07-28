<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::with('product.vendor', 'product.featureImage')->findOrFail($request->variant_id);

        if (auth()->check()) {
            $userId = auth()->id();

            $cartItem = CartItem::where('user_id', $userId)
                ->where('product_id', $request->product_id)
                ->where('variant_id', $request->variant_id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->price = $variant->variant_selling_price;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => $userId,
                    'product_id' => $request->product_id,
                    'variant_id' => $request->variant_id,
                    'quantity' => $request->quantity,
                    'price' => $variant->variant_selling_price,
                ]);
            }

            return $this->getCartData();
        } else {
            $cart = session()->get('cart', []);
            $key = $request->product_id . '_' . $request->variant_id;

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += $request->quantity;
            } else {
                $cart[$key] = [
                    'product_id' => $request->product_id,
                    'variant_id' => $request->variant_id,
                    'title' => $variant->product->title,
                    'business_name' => $variant->product->vendor->business_name,
                    'image' => $variant->product->feature_image_id
                        ? url('public/' . $variant->product->featureImage->feature_image)
                        : 'public/assets/website/images/default.png',
                    'price' => $variant->variant_selling_price,
                    'original_price' => $variant->variant_actual_price,
                    'quantity' => $request->quantity,
                ];
            }

            session()->put('cart', $cart);

            return response()->json([
                'status' => 'success',
                'count' => count($cart),
                'cart' => $this->getGuestGroupedCart($cart)
            ]);
        }
    }

    public function incrementQty(Request $request)
    {
        $key = $request->key;

        if (auth()->check()) {
            [$productId, $variantId] = explode('_', $key);
            $item = CartItem::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->where('variant_id', $variantId)
                ->first();

            if ($item) {
                $item->quantity++;
                $item->save();
            }

            return $this->getCartData();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$key])) {
                $cart[$key]['quantity']++;
                session()->put('cart', $cart);
            }

            return response()->json([
                'cart' => $this->getGuestGroupedCart($cart),
                'count' => count($cart)
            ]);
        }
    }

    public function decrementQty(Request $request)
    {
        $key = $request->key;

        if (auth()->check()) {
            [$productId, $variantId] = explode('_', $key);
            $item = CartItem::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->where('variant_id', $variantId)
                ->first();

            if ($item) {
                if ($item->quantity > 1) {
                    $item->quantity--;
                    $item->save();
                } else {
                    $item->delete();
                }
            }

            return $this->getCartData();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$key])) {
                if ($cart[$key]['quantity'] > 1) {
                    $cart[$key]['quantity']--;
                } else {
                    unset($cart[$key]);
                }
                session()->put('cart', $cart);
            }

            return response()->json([
                'cart' => $this->getGuestGroupedCart($cart),
                'count' => count($cart)
            ]);
        }
    }

    public function getCartData()
    {
        if (auth()->check()) {
            $items = CartItem::where('user_id', auth()->id())->get();

            $groupedCart = [];

            foreach ($items as $item) {
                $businessName = $item->variant->product->vendor->business_name;
                $key = $item->product_id . '_' . $item->variant_id;

                $groupedCart[$businessName][$key] = [
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'title' => $item->variant->product->title,
                    'business_name' => $businessName,
                    'image' => $item->variant->product->feature_image_id
                        ? url('public/' . $item->variant->product->featureImage->feature_image)
                        : 'public/assets/website/images/default.png',
                    'price' => $item->price,
                    'original_price' => $item->variant->variant_actual_price,
                    'quantity' => $item->quantity,
                ];
            }

            return response()->json([
                'cart' => $groupedCart,
                'count' => $items->count()
            ]);
        } else {
            $cart = session()->get('cart', []);
            return response()->json([
                'cart' => $this->getGuestGroupedCart($cart),
                'count' => count($cart)
            ]);
        }
    }

    private function getGuestGroupedCart($cart)
    {
        $grouped = [];

        foreach ($cart as $key => $item) {
            $grouped[$item['business_name']][$key] = $item;
        }

        return $grouped;
    }
}
