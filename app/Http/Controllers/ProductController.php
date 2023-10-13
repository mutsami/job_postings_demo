<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        // Get the currently signed-in user
        $user = Auth::user();
        
        return view('products.index', compact('products', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate user input
        $request ->validate([
            'name'=> 'required',
            'details'=> 'required',
            
            'industry'=> 'required',
            
            'rate'=> 'required'
        ]);


         // Create a new product with user association
    $product = new Product($request->all());
    $product->user_id = auth()->id(); // Set the user who created the product
    $product->save();

        //Redirect the user and send friendly message
        return redirect()->route('products.index')->with('success','Product created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    { 
        $product->delete(); 
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
