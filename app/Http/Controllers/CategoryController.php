<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Fractalistic\Fractal;
use App\Transformers\CategoryTransformer;

use App\Models\Category;

class CategoryController extends Controller
{
    public function list()
    {
        // get categories by tree
        $categories = Category::get()->toTree();

        // transform via transformer and fractal
        $data = Fractal::create()
            ->collection($categories)
            ->transformWith(new CategoryTransformer())
            ->toArray();
        
        // print
        return response()->json($data);
    }
}
