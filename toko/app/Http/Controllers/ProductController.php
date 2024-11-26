<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function filterByBrand($id){
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json(['message' => 'brand not found.',], 404);
        }

        $products = Product::where('brand_id', $id)
                            ->leftJoin('categories', 'categories.id', 'products.brand_id')
                            ->leftJoin('brands', 'brands.id', 'products.brand_id')
                            ->orderByDesc('name')
                            ->get();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function filterByCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found.',], 404);
        }

        $products = Product::where('category_id', $id)
                            ->leftJoin('categories', 'categories.id', 'products.category_id')
                            ->leftJoin('brands', 'brands.id', 'products.brand_id')
                            ->orderByDesc('name')
                            ->get();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('keyword', '');
        // $products = Product::where('name', 'like', '%'.$keyword.'%')
        //                     ->leftJoin('categories', 'categories.id', 'products.category_id')
        //                     ->orderBy('name')
        //                     ->paginate(10);
        $query = Product::query();
        $categoryName = $request->get('category_name');
        $brandName = $request->get('brand_name');
        if($keyword){
            $query = $query->where('name', 'like', '%'.$keyword.'%');
        }

        if($categoryName){
            $query->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name as category_name')
            ->where('categories.category_name', 'like', "%{$categoryName}%");
        }

        if($brandName){
            $query->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name as category_name')
            ->where('categories.category_name', 'like', "%{$brandName}%");
        }

        $products = $query->orderBy('name')->paginate(10);
        
        return response()->json($products);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return response()->json(['message' => 'Produk berhasil disimpan'], 201);
        $request->validate([
            'name' => 'required|string|max:50',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'nama produk wajib isi',
            'name.string' => 'nama produk hanya boleh berupa text',
            'name.max' => 'nama produk tidak boleh lebih dari 50 karakter',
            'category_id.required' => 'kategori produk waib isi',
            'brand_id.required' => 'brand produk waib isi',
            'price.required' => 'harga wajib isi',
            'price.numberic' => 'harga harus berupa angka',
            'stock.required' => 'stok wajib isi',
            'stock.numberic' => 'stok harus berupa bilangan bulay',
            'stock.min' => 'stok harus ada bro',
        ]);
        $product = new Product($request->all());
        // $kategoris = Category::orderBy('category_name')->get();
        $product->create([
            $product->name = $request->input('name'),
            $product->category_id = $request->input('category_id'),
            $product->brand_id = $request->input('brand_id'),
            $product->price = $request->input('price'),
            $product->stock = $request->input('stock')
        ]);
        return response()->json(['message' => 'Produk berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
        // $product = Product::find($id);
        // if($product){
        //     return response()->json(['product' => $product]);
        // } else {
        //     return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        // }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json(['message' => 'Produk berhasil diupdate'], 200);
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'nama produk wajib isi',
            'name.string' => 'nama produk hanya boleh berupa text',
            'name.max' => 'nama produk tidak boleh lebih dari 50 karakter',
            'category_id.required' => 'kategori produk waib isi',
            'brand_id.required' => 'brand produk waib isi',
            'price.required' => 'harga wajib isi',
            'price.numberic' => 'harga harus berupa angka',
            'stock.required' => 'stok wajib isi',
            'stock.numberic' => 'stok harus berupa bilangan bulay',
            'stock.min' => 'stok harus ada bro',
        ]);
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->update($validatedData);
        return response()->json(['message' => 'Produk berhasil di update', 'product' =>
            $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus'], 200);
        // $product = Product::find($id);
        // if(!$product){
        //     return response()->json(['message' => 'Produk tidak Ditemukan'], 404);
        // }

        // $product->delete();
        // return response()->json(['message' => 'produk berhasil dihapus']);
    }
}
