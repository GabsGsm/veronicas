<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $products = Product::select('slug', 'updated_at')
            ->where('active', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $collections = Collection::select('slug', 'updated_at')
            ->where('active', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = view('sitemap', compact('products', 'collections'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
