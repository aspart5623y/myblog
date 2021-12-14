<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchTerm(Request $request)
    {
        $searchResult = Post::search($request->searchInput)->paginate(6);
        return view('search', compact('searchResult'));
    }

}
