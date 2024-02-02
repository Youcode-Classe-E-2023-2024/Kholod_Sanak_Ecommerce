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

        // Order by asc and paginate
        $products = Product::paginate(8);

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
      //  dd($request);
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
        ]);

        $requestData = $request->all();
        $fileName = time().$request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images', $fileName, 'public');
        $requestData['image'] = '/storage/' . $path;
        Product::create($requestData);

        // Redirect back or to a different page after creating the product
        return redirect('/home')->with('success', 'Product created successfully!');
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
        // Find the existing product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            // Handle the case where the product is not found, e.g., redirect back with an error message
            return redirect()->back()->with('error', 'Product not found');
        }

        // Handle file upload if the file input exists
        if ($request->hasFile('image')) {

            // Upload the new image file
            $fileName = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $request->image = '/storage/' . $path;
        }

        // Update the product with request data
        $product->update($request->all());

        $product->image = $request->image;
        $product->save();

        // Redirect back or to a different page after updating the product
        return redirect('home')->with('success', 'Product updated successfully!');
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

    public function showForm(Request $request)
    {
        $id = $request->input('id');


        if ($id === null) {
            return view('productForm');
        } else {
            $product = Product::find($id);

            if ($product) {
                return view('productForm', compact('product'));
            } else {
                // Handle the case where the product with the given ID is not found.
                return redirect()->route('product')->with('error', 'Product not found.');
            }
        }
    }




}
