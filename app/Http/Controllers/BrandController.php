<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Manual;

class BrandController extends Controller
{
    public function showLetter(string $letter)
    {
        $letter = strtoupper($letter);
        $brands = Brand::query()
            ->orderBy('name')
            ->get()
            ->filter(fn (Brand $brand) => strtoupper(substr($brand->name, 0, 1)) === $letter);

        return view('pages.brands_by_letter', compact('brands', 'letter'));
    }

    public function show($brand_id, $brand_slug)
    {
        $brand = Brand::findOrFail($brand_id);

        $manuals = $brand->manuals()
            ->orderBy('name')
            ->get();

        $popularBrandManuals = $brand->manuals()
            ->orderByDesc('view_count')
            ->orderBy('name')
            ->limit(5)
            ->get();

        return view('pages/manual_list', [
            'brand' => $brand,
            'manuals' => $manuals,
            'popularBrandManuals' => $popularBrandManuals,
        ]);
    }
}
