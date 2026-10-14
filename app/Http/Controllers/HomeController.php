<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $allProducts = Product::all();
        $featuredProducts = $allProducts->take(8);
        $discountedProducts = $allProducts->filter(function (Product $product): bool {
            return $product->discount_percent !== null;
        })->take(8);

        $categories = $allProducts->groupBy('category')->map->count()->sortDesc();

        return view('home', [
            'featuredProducts' => $featuredProducts,
            'discountedProducts' => $discountedProducts,
            'categories' => $categories,
            'totalCount' => $allProducts->count(),
        ]);
    }

    public function catalog(Request $request): View
    {
        $allProducts = Product::all();

        $brands = $allProducts->groupBy('brand')->map->count()->sortDesc();
        $categories = $allProducts->groupBy('category')->map->count()->sortDesc();

        $catalogMinPrice = (int) floor($allProducts->min('price') ?? 0);
        $catalogMaxPrice = (int) ceil($allProducts->max('price') ?? 2000);

        $filtered = $allProducts;

        if ($request->filled('q')) {
            $q = mb_strtolower(trim((string) $request->input('q')));
            $filtered = $filtered->filter(function (Product $product) use ($q): bool {
                return str_contains(mb_strtolower($product->name), $q)
                    || str_contains(mb_strtolower($product->description ?? ''), $q)
                    || str_contains(mb_strtolower($product->brand), $q)
                    || str_contains(mb_strtolower($product->category), $q);
            });
        }

        if ($request->filled('brands')) {
            $selectedBrands = (array) $request->input('brands');
            $filtered = $filtered->filter(function (Product $product) use ($selectedBrands): bool {
                return in_array($product->brand, $selectedBrands, true);
            });
        }

        if ($request->filled('category')) {
            $category = (string) $request->input('category');
            $filtered = $filtered->filter(function (Product $product) use ($category): bool {
                return $product->category === $category;
            });
        }

        if ($request->filled('min_price')) {
            $minPrice = (float) $request->input('min_price');
            $filtered = $filtered->filter(function (Product $product) use ($minPrice): bool {
                return $product->price >= $minPrice;
            });
        }

        if ($request->filled('max_price')) {
            $maxPrice = (float) $request->input('max_price');
            $filtered = $filtered->filter(function (Product $product) use ($maxPrice): bool {
                return $product->price <= $maxPrice;
            });
        }

        if ($request->boolean('only_offers')) {
            $filtered = $filtered->filter(function (Product $product): bool {
                return $product->discount_percent !== null;
            });
        }

        $sort = (string) $request->input('sort', 'relevance');
        if ($sort === 'price_asc') {
            $filtered = $filtered->sortBy('price');
        } elseif ($sort === 'price_desc') {
            $filtered = $filtered->sortByDesc('price');
        } elseif ($sort === 'rating_desc') {
            $filtered = $filtered->sortByDesc('rating');
        } elseif ($sort === 'name_asc') {
            $filtered = $filtered->sortBy('name');
        }

        $products = $filtered->values();

        return view('catalog', [
            'products' => $products,
            'totalCount' => $products->count(),
            'brands' => $brands,
            'categories' => $categories,
            'catalogMinPrice' => $catalogMinPrice,
            'catalogMaxPrice' => $catalogMaxPrice,
            'selectedBrands' => (array) $request->input('brands', []),
            'selectedCategory' => $request->input('category'),
            'selectedMinPrice' => $request->input('min_price', $catalogMinPrice),
            'selectedMaxPrice' => $request->input('max_price', $catalogMaxPrice),
            'currentSort' => $sort,
            'searchQuery' => $request->input('q', ''),
            'onlyOffers' => $request->boolean('only_offers'),
        ]);
    }

    public function show(Product $product): View
    {
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->get()
            ->filter(function (Product $item) use ($product): bool {
                return $item->category === $product->category || $item->brand === $product->brand;
            })
            ->take(4);

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('id', '!=', $product->id)->take(4)->get();
        }

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function cart(): View
    {
        return view('cart');
    }
}
