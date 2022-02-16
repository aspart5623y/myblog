<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request, CategoryRepository $categoryRepository)
    {
        $validatedData = $request->validated();
        $category = $categoryRepository->create($validatedData);
        return redirect()->route('category.index')
                ->with('category_added', 'Category has been added successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, CategoryRepository $categoryRepository, Category $category)
    {
        $validatedData = $request->validated();
        $category = $categoryRepository->update($validatedData, $category);
        return redirect()->route('category.index')
                ->with('category_added', 'Category has been updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')
                ->with('category_added', 'Category has been deleted successfully!');
    }
}
