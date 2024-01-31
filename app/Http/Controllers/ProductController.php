<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all products
        $allProducts = Product::all();

        // Order by desc and paginate
        $products = Product::orderBy('created_at', 'asc')->paginate(8);

        // Count all products
        $productCount = $allProducts->count();

        // Filter by date or alphabetically
        $sort = request('sort');

        if ($sort === 'alphabetically') {
            // Sort alphabetically
            $products = Product::orderBy('name')->paginate(8);
        } elseif ($sort === 'date') {
            // Sort by date
            $products = Product::orderBy('created_at', 'desc')->paginate(8);
        }

        return view('home', compact('products', 'productCount'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate the form data
        $product = new Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->content = $request->content;

        // Create a new product
        $product->save();

        // Redirect back or to a different page after creating the product
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            // Handle the case where the product is not found, e.g., redirect back with an error message
            return redirect()->back()->with('error', 'Product not found');
        }
        // If the product exists, pass it to the view
        return view('product', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the form data if needed
        // Find the existing product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            // Handle the case where the product is not found, e.g., redirect back with an error message
            return redirect()->back()->with('error', 'Product not found');
        }

        // Update the product with new values
        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->content = $request->content;

        // Save the updated product
        $product->save();

        // Redirect back or to a different page after updating the product
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the existing product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            // Handle the case where the product is not found, e.g., redirect back with an error message
            return redirect()->back()->with('error', 'Product not found');
        }

        // Delete the product
        $product->delete();

        // Redirect back or to a different page after deleting the product
        return redirect('/home')->with('success', 'Product deleted successfully');
    }


}
