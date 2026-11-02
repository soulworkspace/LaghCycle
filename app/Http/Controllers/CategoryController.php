<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::root()
            ->active()
            ->whereIn('type', ['bicycle', 'motorcycle'])
            ->with(['children' => fn ($query) => $query->active()->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        return view('categories.index', compact('categories'));
    }
}
