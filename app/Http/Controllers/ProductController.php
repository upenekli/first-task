<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use ElasticScoutDriverPlus\Support\Query;

class ProductController extends Controller
{
    public function list(): string
    {
        // prepare query for es
        $searchQuery = Query::wildcard()
            ->field('slug')
            ->value('veniam*');

        // run the query on es
        $searchResults = Product::searchQuery($searchQuery)
            ->execute();

        // result data documents
        $data = $searchResults->documents();

        // print
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
