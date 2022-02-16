<?php
namespace App\Repositories;

use App\Models\Category;


class CategoryRepository {
    public function create($data)
    {

        $category = new Category();
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->save();
        
        if($category) {
            return $category;
        } else {
            return response()->json('Error saving data', 500);
        }
        
    }

    public function update($data, $category)
    {
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->save();
        
        if($category) {
            return $category;
        } else {
            return response()->json('Error saving data', 500);
        }
        
    }
}