<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public $jsonApiUrl;

    public function __construct()
    {
        $this->jsonApiUrl = env('JSON_API_URL');
    }

    public function getProducts()
    {
        try {
            $limit = request('limit') ?? 10;
            $skip = request('skip') ?? 10;
            $res = Http::get("{$this->jsonApiUrl}/products?limit={$limit}&skip={$skip}");

            if ($res->failed()) {
                Log::error('Error: ' . $res->body());
                return response()->json("Something went wrong", 500);
            }


            $collections = $res->json();


            $products = $collections['products'];

            $products = ProductResource::collection($products);
            $data = collect();
            $data['products'] = $products;
            $data['skip'] = $collections['skip'];
            $data['limit'] = $collections['limit'];
            $data['total'] = $collections['total'];

            return response()->json($data);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error: ' . $th->getMessage());
        }
    }

    public function getProduct($productId)
    {
        try {
            $res = Http::get("{$this->jsonApiUrl}/products/{$productId}");
            $product = $res->json();
            $product = new ProductResource($product);
            return response()->json($product);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error: ' . $th->getMessage());
        }
    }
}
