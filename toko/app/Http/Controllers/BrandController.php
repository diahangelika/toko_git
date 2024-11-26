<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $brands = Brand::where('brand_name', 'like', '%'.$keyword.'%')->orderByDesc('brand_name')->paginate(10);
        // return response()->json(['categories$categories' => $categories]); tanpa orm
        return response()->json($brands);
    }
    public function store(Request $request)
    {
        Brand::create($request->all());
        return response()->json(['message' => 'kategori berhasil disimpan'], 201);
        $request->validate([
            'brand_name' => 'required|string|max:50',
        ], [
            'brand_name.required' => 'brand produk wajib isi',
            'brand_name.string' => 'brand produk hanya boleh berupa text',
            'brand_name.max' => 'brand produk tidak boleh lebih dari 50 karakter',
        ]);
        $brand = new Brand($request->all());
        // $kategoris = brand::orderBy('brand_name')->get();
        $brand->create([
            $brand->brand_name = $request->input('brand_name')
        ]);
        return response()->json(['message' => 'brand berhasil ditambah']);
    }
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());
        return response()->json(['message' => 'Brand berhasil diupdate'], 200);
        $request->validate([
            'brand_name' => 'required|string|max:50',
        ], [
            'brand_name.required' => 'brand produk wajib isi',
            'brand_name.string' => 'brand produk hanya boleh berupa text',
            'brand_name.max' => 'brand produk tidak boleh lebih dari 50 karakter',
        ]);
        $brand = Brand::find($id);
        if(!$brand){
            return response()->json(['message' => 'brand tidak ditemukan'], 404);
        }

        $brand->update($validatedData);
        return response()->json(['message' => 'brand berhasil di update', 'brand' =>
            $brand]);
    }
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }
}
