<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
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
     * Show the application product dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Get All Active products from Product table
        $products = Product::with('discounts')->where('status', 1)->get();
        
        //Get Cart details from session
        $cart = session()->get('cart');
        if ($cart == null)
            $cart = [];
        return view('products', compact('products', 'cart'));
    }
}
