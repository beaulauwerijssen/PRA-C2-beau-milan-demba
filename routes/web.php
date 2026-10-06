<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
2017-10-30 setup for urls
Home:			/
Brand:			/52/AEG/
Type:			/52/AEG/53/Superdeluxe/
Manual:			/52/AEG/53/Superdeluxe/8023/manual/
				/52/AEG/456/Testhandle/8023/manual/

If we want to add product categories later:
Productcat:		/category/12/Computers/
*/

use App\Models\Brand;
use App\Models\Manual;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LocaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// Homepage
Route::get('/', function () {
    $brands = Brand::all()->sortBy('name');
    $popularManuals = Manual::popular(10);
    $name = 'Beau, Milan en Demba';
    $brandCount = $brands->count();

    return view('pages.homepage', compact('brands', 'popularManuals', 'name', 'brandCount'));
})->name('home');

Route::get('/contact', function () {
    $brands = Brand::all()->sortBy('name');
    return view('pages.contact', compact('brands'));
})->name('contact');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:255'],
        'subject' => ['required', 'string', 'max:150'],
        'message' => ['required', 'string', 'max:5000'],
    ]);

    Mail::raw($validated['message'], function ($mail) use ($validated) {
        $mail->to(config('mail.from.address'))
            ->replyTo($validated['email'], $validated['name'])
            ->subject($validated['subject']);
    });

    return to_route('contact')->with('contact_sent', 'Bedankt voor je bericht. We nemen zo snel mogelijk contact met je op.');
})->name('contact.send');

Route::get('/over-ons', function () {
    $brands = Brand::all()->sortBy('name');
    return view('pages.contact', compact('brands'));
})->name('about');

Route::get('/manual/{language}/{brand_slug}/', [RedirectController::class, 'brand']);
Route::get('/manual/{language}/{brand_slug}/brand.html', [RedirectController::class, 'brand']);

Route::get('/datafeeds/{brand_slug}.xml', [RedirectController::class, 'datafeed']);

// Locale routes
Route::get('/language/{language_slug}/', [LocaleController::class, 'changeLocale'])->name('change.locale');

// List of manuals for a brand
Route::get('/{brand_id}/{brand_slug}/', [BrandController::class, 'show']);

// Detail page for a manual
Route::get('/{brand_id}/{brand_slug}/{manual_id}/', [ManualController::class, 'show']);

// Generate sitemaps
Route::get('/generateSitemap/', [SitemapController::class, 'generate']);
