<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $categories = Category::where('category_name', 'like', '%'.$keyword.'%')
                                ->orderByDesc('category_name')
                                ->paginate(10);
        // return response()->json(['categories$categories' => $categories]); tanpa orm
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        Category::create($request->all());
        return response()->json(['message' => 'kategori berhasil disimpan'], 201);
        $request->validate([
            'category_name' => 'required|string|max:50',
        ], [
            'category_name.required' => 'kategori produk wajib isi',
            'category_name.string' => 'kategori produk hanya boleh berupa text',
            'category_name.max' => 'kategori produk tidak boleh lebih dari 50 karakter',
        ]);
        $category = new Category($request->all());
        // $kategoris = Category::orderBy('category_name')->get();
        $category->create([
            $category->category_name = $request->input('category_name')
        ]);
        return response()->json(['message' => 'Kategori berhasil ditambah']);
    }
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json(['message' => 'kategori berhasil diupdate'], 200);
        $request->validate([
            'category_name' => 'required|string|max:50',
        ], [
            'category_name.required' => 'kategori produk wajib isi',
            'category_name.string' => 'kategori produk hanya boleh berupa text',
            'category_name.max' => 'kategori produk tidak boleh lebih dari 50 karakter',
        ]);
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message' => 'kategori tidak ditemukan'], 404);
        }

        $category->update($validatedData);
        return response()->json(['message' => 'kategori berhasil di update', 'category' =>
            $category]);
    }
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }

}
