<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addNew()
    {
        return view('admin.add-category');
    }

    public function storeCategory(Request $request)
    {
        $category_name = $request->category_name;
        $category_desc = $request->category_desc;

        $this->validate($request, [
            'category_name' => 'required|unique:categories',
            'category_desc' => 'required|max:50'
        ]);

        $category = new Category();
        $category->title = $category_name;
        $category->description = $category_desc;
        $category->save();
        return redirect()->route('admin.category')
                ->with('category_added', 'Category has been added successfully!');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.edit-category', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $title = $request->category_name;
        $desc = $request->category_desc;

        $this->validate($request, [
            'category_name' => 'required',
            'category_desc' => 'required|max:50'
        ]);

        $category = Category::find($request->id);
        $category->title = $title;
        $category->description = $desc;
        $category->save();
        return redirect()->route('admin.category')
                ->with('category_added', 'Category has been updated successfully!');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category')
                ->with('category_added', 'Category has been deleted successfully!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('admin.manage-categories', compact('categories'));
    }
}
