<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class SyncProductsService
{
    public function syncBrazilianProvider()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/brazilian_provider');

        $response->throw();

        $productsBRProvider = $response->json();
        foreach ($productsBRProvider as $product) {
            Log::debug('Syncing products - ' . $product['nome']);
            $found = Product::where('suplier_id', $product['id'])->where('suplier', 'brazilian_provider')->count();
            if ($found > 0) {
                Log::debug('Syncing products - ' . $product['nome'] . ' - ALREADY EXISTS');
            }
            if ($found == 0) {
                $saved = Product::create([
                    'name' => $product['nome'],
                    'description' => $product['descricao'],
                    'keyword' => $product['categoria'],
                    'price' => $product['preco'],
                    'material' => $product['material'],
                    'department' => $product['departamento'],
                    'suplier' => 'brazilian_provider',
                    'hasDiscount' => false,
                    'discount' => 0,
                    'suplier_id' => $product['id']

                ]);
                $saved->images()->create([
                    'path' => $product['imagem']
                ]);
            }
        };
    }
    public function syncEuropeanProvider()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/european_provider');

        $response->throw();

        $productsEUProvider = $response->json();
        foreach ($productsEUProvider as $product) {
            Log::debug('Syncing products - ' . $product['name']);
            $found = Product::where('suplier_id', $product['id'])->where('suplier', 'european_provider')->count();
            if ($found > 0) {
                Log::debug('Syncing products - ' . $product['name'] . ' - ALREADY EXISTS');
            }
            if ($found == 0) {
                $saved =  Product::create([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'keyword' =>  $product['details']['adjective'],
                    'price' => $product['price'],
                    'material' => $product['details']['material'],
                    'department' => null,
                    'suplier' => 'european_provider',
                    'hasDiscount' => $product['hasDiscount'],
                    'discount' => floatval($product['discountValue']),
                    'suplier_id' => $product['id']
                ]);
                foreach ($product['gallery'] as $image) {
                    $saved->images()->create([
                        'path' => $image
                    ]);
                }
            }
        };
    }
}
