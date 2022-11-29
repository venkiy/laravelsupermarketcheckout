<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDiscount;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Fetch Cart details from session
        $cart = session()->get('cart');
        //print_r($cart);exit;
        if ($cart == null)
            $cart = [];        
        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $cartPosts = $request->post('cart');
        //grouping cart products        
        $aggregated = [];

        foreach ($cartPosts as $row) {
            $id = $row['id'];
            $qty = $row['qty'];

            if (!array_key_exists($id, $aggregated)) {
                $aggregated[$id] = [
                'id' => $id,
                'qty' => $qty,
                ];
                continue;
            }
            $aggregated[$id]['qty'] += $qty;
        }

        $cartProducts = array_values($aggregated);
        
        //calculate product special price based on cart quantity
        foreach ($cartProducts as $product_id => $cProduct) {
            $qty = (isset($cProduct)) ? $cProduct['qty']:0;            
            $getcartProduct = Product::where('id', $cProduct['id'])->where('status', 1)->first();
            $getcartProductDiscount = ProductDiscount::where('product_id', $cProduct['id'])->where('status', 1)->get();
            if(count($getcartProductDiscount)>0) {                
               $discountQty = $getcartProductDiscount[0]['qty']; 
               $discountPrice = $getcartProductDiscount[0]['special_price'];                
               if($qty < $discountQty) {
                $cartProducts[$product_id]['price'] = $cProduct['qty']*$getcartProduct['price'];
               } else if (isset($getcartProductDiscount[1]['qty']) && $qty >= $getcartProductDiscount[1]['qty'] ) {
                $discountQty1 = $getcartProductDiscount[1]['qty'];
                $discountPrice1 = $getcartProductDiscount[1]['special_price'];
                $specialPrice = ($qty%$discountQty1)* $getcartProduct['price'];
                $specialdisccountPrice = floor($qty/$discountQty1)* $discountPrice1;
                $cartProducts[$product_id]['price'] = $specialPrice + $specialdisccountPrice;
                } else if (isset($getcartProductDiscount[0]['combo_product_id']) && in_array($getcartProductDiscount[0]['combo_product_id'], array_column($cartProducts, 'id')) ) { 
                    $comboproduct = array_search($getcartProductDiscount[0]['combo_product_id'], array_column($cartProducts, 'id'));
                    $comboProductqty = ($comboproduct==0)? $cartProducts[$comboproduct]['qty']: 0;
                    $specialcomboPrice = ($qty-$comboProductqty)* $getcartProduct['price'];
                    $specialcombodisccountPrice = ($qty-($qty-$comboProductqty))* $discountPrice;
                    $cartProducts[$product_id]['price'] = $specialcomboPrice + $specialcombodisccountPrice;
                } else {
                $discountPrice = isset($getcartProductDiscount[0]['combo_product_id'])? $getcartProduct['price']: $discountPrice;
                $specialPrice = ($qty%$discountQty)* $getcartProduct['price'];
                $specialdisccountPrice = floor($qty/$discountQty)* $discountPrice;
                $cartProducts[$product_id]['price'] = $specialPrice + $specialdisccountPrice;
               }
            }
            $cartProducts[$product_id]['name'] = $getcartProduct['name'];
        }
                
        session()->put('cart', $cartProducts);

        return response()->json([
            'status' => 'added'
        ]);
    }

    public function ClearCart(Request $request)
    {
        session()->forget('cart');

        return response()->json([
            'status' => 'updated'
        ]);
    }
}
