<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all();

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    public function create(Request $request): View
    {
        return view('admin.category.create');
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());

        $request->session()->flash('category.id', $category->id);

        return redirect()->route('admin.categories.index');
    }

    public function show(Request $request, Category $category): View
    {
        return view('admin.category.show', [
            'category' => $category,
        ]);
    }

    public function edit(Request $request, Category $category): View
    {
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        $request->session()->flash('category.id', $category->id);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
