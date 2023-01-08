<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\Product;

class PurchaseService
{
    public function createPurchase(array $body): array
    {
        $prices = $this->computePurchaseValues($body['products']);

        $purchase = Purchase::create([
            'client_name' => $body['client']['name'],
            'client_email' => $body['client']['email'],
            'client_phone' => $body['client']['phone'],
            'client_address' => $body['client']['address'],
            'client_city' => $body['client']['city'],
            'client_zip' => $body['client']['zip'],
            'client_country' => $body['client']['country'],
            'client_cpf' => $body['client']['cpf'],
            'total_price' => $prices['total_price'],
            'total_price_wt_discount' =>  $prices['total_price_wt_discount'],
            'total_value_of_discount' => $prices['total_value_of_discount']
        ]);

        $purchase->products()->attach($body['products']);

        return [
            'success' => true,
            'message' => 'Purchase created successfully!',
            'data' => [
                'products' => $purchase->products,
                'total_price' => $purchase->total_price,
                'total_price_wt_discount' => $purchase->total_price_wt_discount,
                'total_value_of_discount' => $purchase->total_value_of_discount,
                'client' => [
                    'name' => $purchase['client_name'],
                    'email' => $purchase['client_email'],
                    'phone' => $purchase['client_phone'],
                    'address' => $purchase['client_address'],
                    'city' => $purchase['client_city'],
                    'zip' => $purchase['client_zip'],
                    'country' => $purchase['client_country'],
                    'cpf' => $purchase['client_cpf'],
                ]

            ]
        ];
    }

    public function computePurchaseValues(array $productIds)
    {

        $products = Product::whereIn('id', $productIds)->get();
        $totalPrice = 0;
        $total_price_wt_discount = 0;
        $total_value_of_discount = 0;

        foreach ($products as $product) {
            $totalPrice += $product->price;
            $total_price_wt_discount += $product->hasDiscount ? $product->price - ($product->price * $product->discount) : 0;
            $total_value_of_discount += $product->hasDiscount ? $product->price * $product->discount : 0;
        }
        return [
            'total_price' => $totalPrice,
            'total_price_wt_discount' => $total_price_wt_discount,
            'total_value_of_discount' => $total_value_of_discount
        ];
    }
}
