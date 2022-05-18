<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Fractalistic\Fractal;

use App\Models\Category;

use App\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    public function list() {

        $categories = Category::get()->toTree();

        //echo json_encode($categories, JSON_PRETTY_PRINT);

        $f = Fractal::create()
            ->collection($categories)
            ->transformWith(new CategoryTransformer())
            ->toArray();
            
        echo json_encode($f, JSON_PRETTY_PRINT);
    }
}
