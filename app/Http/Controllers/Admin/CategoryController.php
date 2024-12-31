<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_ROOT = 'admin.category.';
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(15);
        return view(self::PATH_ROOT . 'index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'img_url'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        try {           
            DB::transaction(function () use ($validated, $request) {
                // Tạo slug từ tên
                $slug = Str::slug($validated['name'], '-');
                $dataCategory = [
                    'name' => $validated['name'],
                    'slug' => $slug,
                ];
                if ($request->hasFile('img_url')) {
                    $dataCategory['img_url'] = Storage::put('admin/categories', $request->file('img_url'));
                }

                // Tạo category mới
                Category::query()->create($dataCategory);
            });
            toastr()->success('Danh mục được tạo thành công.');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            //throw $th;
            //return back()->with('error', 'An error occurred while creating category.');
            toastr()->error('Tạo danh mục thất bại vui lòng kiểm tra lại.');
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'img_url'  => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        try {           
            DB::transaction(function () use ($validated, $request) {
                $category = Category::findorFail($request->id);
                // Tạo slug từ tên
                $slug = Str::slug($validated['name'], '-');
                $dataCategory = [
                    'name' => $validated['name'],
                    'slug' => $slug ?? $category->slug,
                ];
                if ($request->hasFile('img_url')) {
                    Storage::delete($category->img_url); 
                    $dataCategory['img_url'] = Storage::put('admin/categories', $request->file('img_url'));
                }

                // Tạo category mới
                $category->update($dataCategory);
                toastr()->success('Danh mục được sửa thành công.');
            });
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            //throw $th;
            //return back()->with('error', 'An error occurred while creating category.');
            toastr()->error('Sửa danh mục thất bại vui lòng kiểm tra lại.');
            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
