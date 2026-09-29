<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Manual;

class BrandController extends Controller
{
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
