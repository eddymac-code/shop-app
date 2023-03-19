<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->hasAccessTo('view product category')) {
            return redirect('dashboard')->with('error', 'Not allowed!');
        }

        $data = ProductCategory::all();

        return view('product_category.data', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasAccessTo('create product category')) {
            return redirect('dashboard')->with('error', 'Not allowed!');
        }
        
        return view('product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasAccessTo('create product category')) {
            return redirect('dashboard')->with('error', 'Not allowed!');
        }
        
        $this->validate($request, [
            'name' => 'required|unique:product_categories'
        ]);

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/product_categories';
            $image = $request->file('image');
            $image_name = date("YmdHis").$image->getClientOriginalName();
            $image->storeAs($destination_path, $image_name);
        }

        $request->user()->categories()->create([
            $request->name,
            $request->description,
            $image_name,
        ]);

        return redirect()->route('categories')->with('success', 'Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        if (!Auth::user()->hasAccessTo('view product category')) {
            return redirect('dashboard')->with('error', 'Not allowed!');
        }
        
        return view('product_category.show', ['productCategory' => $productCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        if (!Auth::user()->hasAccessTo('update product category')) {
            return redirect('dashboard')->with('error', 'Not allowed!');
        }
        
        return view('product_category.edit', ['productCategory' => $productCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        if (!Auth::user()->hasAccessTo('update product category')) {
            return redirect('dashboard')->with('error', 'Not allowed!');
        }
        
        $this->validate($request, [
            'name' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/product_category';
            $image = $request->file('image');
            $image_name = date("YmdHis").$image->getClientOriginalName();
            $image->storeAs($destination_path, $image_name);
        }

        $productCategory->update([
            $request->name,
            $request->description,
            $image_name,
        ]);

        return redirect()->route('categories')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if (!Auth::user()->hasAccessTo('delete product category')) {
            return redirect('dashboard')->with('error', 'Not allowed!');
        }
        
        $productCategory->delete();

        return redirect()->route('categories')->with('success', 'Category Deleted!');
    }
}
