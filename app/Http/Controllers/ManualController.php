<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    public function show($brand_id, $brand_slug, $manual_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $manual = $brand->manuals()->findOrFail($manual_id);

        // Count only real manual views, not list pages or homepage clicks.
        $manual->increment('view_count');

        return view('pages/manual_view', [
            'manual' => $manual,
            'brand' => $brand,
            'type' => $manual,
        ]);
    }
}
