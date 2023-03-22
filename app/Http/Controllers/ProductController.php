<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::user()->hasAccessTo('view products')) {
            return redirect()->route('dashboard')->with('error', 'Not allowed!');
        }
        
        if ($request->search) {
            $data = Product::where('name', 'LIKE', '%$request->search%')->get();
        } else {
            $data = Product::all();
        }
        
        // $data = Product::all();
        return view('product.data', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasAccessTo('create products')) {
            return redirect()->route('dashboard')->with('error', 'Not allowed!');
        }

        $categories = ProductCategory::all();
        return view('product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasAccessTo('create products')) {
            return redirect()->route('dashboard')->with('error', 'Not allowed!');
        }

        $this->validate($request, [
            'category' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'unit' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $product = new Product();
        $product->user_id = $request->user()->id;
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->unit = $request->unit;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/products';
            $image = $request->file('image');
            $image_name = date("YmdHis").$image->getClientOriginalName();
            $image->storeAs($destination_path, $image_name);

            $product->image = $image_name;

        }
        
        $product->save();

        return redirect()->route('products')->with('success', 'Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (!Auth::user()->hasAccessTo('view products')) {
            return redirect()->route('dashboard')->with('error', 'Not allowed!');
        }

        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (!Auth::user()->hasAccessTo('update products')) {
            return redirect()->route('dashboard')->with('error', 'Not allowed!');
        }

        $categories = ProductCategory::all();
        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (!Auth::user()->hasAccessTo('update products')) {
            return redirect()->route('dashboard')->with('error', 'Not allowed!');
        }
        
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'unit' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->unit = $request->unit;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/products';
            $image = $request->file('image');
            $image_name = date("YmdHis").$image->getClientOriginalName();
            $storedimg = $image->storeAs($destination_path, $image_name);

            if ($storedimg) {
                Storage::delete('public/images/products/'.$product->image);
            }

            $product->image = $image_name;

        }

        $product->save();

        return redirect()->route('products')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!Auth::user()->hasAccessTo('delete products')) {
            return redirect()->route('dashboard')->with('error', 'Not allowed!');
        }

        $product->delete();

        return redirect()->route('products')->with('success', 'Product Deleted!');
    }
}
