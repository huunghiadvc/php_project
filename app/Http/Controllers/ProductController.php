<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\MockObject\Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = DB::table("products")->paginate(20);
        return view("admin.products", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'height' => 'required|numeric',
            'length_col' => 'required|numeric',
            'width' => 'required|numeric',
            'base_unit' => 'required|string|max:255',
            'producer' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'inserted_at' => now(),
            'inserted_by' => Auth::user()
        ]);

        $product = Product::create($validatedData);

        return redirect()->back()->with(['status' => 'success', 'message' => 'Product created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = DB::table("products")
            -> where("id", $id)
            -> first();
        return view("admin.product", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'height' => 'required|numeric',
            'length_col' => 'required|numeric',
            'width' => 'required|numeric',
            'base_unit' => 'required|string',
            'producer' => 'required|string',
            'quantity' => 'required|integer',
            'update_at' => now(),
            'updated_by' => Auth::user()
        ]);

        try {
            DB::table("products")
                -> where("id", $id)
                -> update($validatedData);
            return redirect()
                -> route('dashboard.product', ['id' => $id])
                -> with('success', 'Product updated successfully!');
        } catch (Exception $e) {
            return redirect()
                -> route('dashboard.show', ['id' => $id])
                -> with('error', 'Product update failed! '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Delete the product
        $product->delete();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Product deleted successfully']);
    }
}
