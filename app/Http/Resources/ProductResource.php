<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $kurs = 15500;
        $data = parent::toArray($request);
        $data['price'] = "Rp. " . number_format(ceil(($data['price'] * $kurs) / 100000) * 100000);
        $data['rating'] = ceil($data['rating']);
        return $data;
    }
}
