<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class CartController extends Controller
{

    public function index(): View
    {
        $products = Product::all();
        $cart = $this->getOrCreateCart();

        return view("frontend.cart.index", ["cart" => $cart, "products" => $products]);

    }

    /**
     *
     * Lists the cart content
     *
     * @return Cart
     */
    public function getOrCreateCart(): Cart
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['code' => Str::random(8)]
        );
        return $cart;
    }

    /**
     * Add product as cart detail
     *
     * @param Product $product
     * @param int $quantity
     * @return RedirectResponse
     */
    public function add(Product $product, int $quantity = 1): RedirectResponse
    {
        $cart = $this->getOrCreateCart();
        $cart->details()->create([
            "product_id" => $product->id,
            "quantity" => $quantity,
        ]);

        return redirect("/addtocart");
    }

    /**
     *
     * Remove cart detail from cart
     *
     * @param CartDetails $cartDetails
     * @return RedirectResponse
     */
    public function remove(CartDetails $cartDetails): RedirectResponse
    {
        $cartDetails->delete();
        return redirect("/addtocart");
    }
}
