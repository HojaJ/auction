<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('updated_at')->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            Category::create([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.categories.index')->with('success', __('Category is created'));
        }catch (\Exception $e){
            dd('Bu at öň bar: ' .  $request->name);
        }
    }
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', __('Category is updated'));
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', __('Category is deleted'));
    }
}
