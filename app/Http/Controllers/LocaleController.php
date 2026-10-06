<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function changeLocale(string $language_slug, Request $request)
    {
        $allowedLanguages = ['nl', 'en'];

        if (in_array($language_slug, $allowedLanguages, true)) {
            $request->session()->put('locale', $language_slug);
            app()->setLocale($language_slug);
        }

        return redirect()->back();
    }
}
