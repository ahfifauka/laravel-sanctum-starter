<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    private $jsonApiUrl;

    public function __construct()
    {
        $this->jsonApiUrl = env('JSON_API_URL');
    }

    public function getCategories()
    {
        $res = Http::get("{$this->jsonApiUrl}/products/category-list");
        $categories = collect($res->object());

        return response()->json($categories);
    }
}
