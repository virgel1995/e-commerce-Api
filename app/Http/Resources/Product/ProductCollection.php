<?php

namespace App\Http\Resources\Product;
use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Http\Resources\Json\ResourceCollection;
class ProductCollection extends JsonResource
{


    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            // 'price' => $this->price,
            // 'stock' => $this->stock == 0 ? 'Out Of Stock' : $this->stock,
            'discount' => $this->discount == 0 ? 'No Discount' : $this->discount,
            'totalPrice' => round((1 - ($this->discount / 100)) * $this->price, 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'No Rating Yet',
            'href' => [
                'link' => route('products.show', $this->id)
            ],
        ];
    }
}
