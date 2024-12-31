<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_ROOT = 'admin.tag.';


    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->paginate(15);
        return view(self::PATH_ROOT . 'index', compact('tags'));
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
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);
        try {           
            DB::transaction(function () use ($validated, $request) {
                // Tạo slug từ tên
                $slug = Str::slug($validated['name'], '-');
                $dataTag = [
                    'name' => $validated['name'],
                    'slug' => $slug,
                ];

                // Tạo tag mới
                Tag::query()->create($dataTag);
            });
            toastr()->success('Tag được tạo thành công.');
            flash()->success('Tag được tạo thành công.');
            return redirect()->route('tags.index');
        } catch (\Throwable $th) {
            //throw $th;
            //return back()->with('error', 'An error occurred while creating tag.');
            toastr()->error('Tạo tag thất bại vui lòng kiểm tra lại.');
            return redirect()->route('tags.index');
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
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);
        try {           
            DB::transaction(function () use ($validated, $id) {
                // Tạo slug từ tên
                $tag = Tag::findOrFail($id);
                $slug = Str::slug($validated['name'], '-');
                $dataTag = [
                    'name' => $validated['name'],
                    'slug' => $slug,
                ];

                // Tạo tag mới
                $tag->update($dataTag);
            });
            toastr()->success('Tag được Sửa thành công.');
            flash()->success('Tag được Sửa thành công.');
            return redirect()->route('tags.index');
        } catch (\Throwable $th) {
            //throw $th;
            //return back()->with('error', 'An error occurred while creating tag.');
            toastr()->error('Sửa tag thất bại vui lòng kiểm tra lại.');
            return redirect()->route('tags.index');
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
