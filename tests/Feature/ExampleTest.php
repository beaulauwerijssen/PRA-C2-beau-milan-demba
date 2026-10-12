<?php

use App\Models\Brand;
use App\Models\Manual;
use Illuminate\Support\Facades\Mail;

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('the contact and about footer routes return a successful response', function () {
    $this->get('/contact')->assertStatus(200);
    $this->get('/over-ons')->assertStatus(200);
});

test('brand letter pages list matching brands and link to their brand pages', function () {
    $bosch = Brand::create(['name' => 'Bosch']);
    Brand::create(['name' => 'Braun']);
    Brand::create(['name' => 'Samsung']);

    $response = $this->get('/B/');

    $response->assertOk()
        ->assertSee('Bosch')
        ->assertSee('Braun')
        ->assertDontSee('Samsung')
        ->assertSee("/{$bosch->id}/Bosch/");

    $this->get('/b/')
        ->assertOk()
        ->assertSee('Brands starting with B');

    $this->get('/C/')->assertOk()->assertSee('There are no brands starting with C.');
    $this->get('/123/')->assertNotFound();
});

test('a valid contact message is sent', function () {
    Mail::fake();

    $response = $this->post('/contact', [
        'name' => 'Ada Lovelace',
        'email' => 'ada@example.com',
        'subject' => 'Handleiding gezocht',
        'message' => 'Ik zoek een handleiding voor mijn apparaat.',
    ]);

    $response->assertRedirect('/contact')
        ->assertSessionHas('contact_sent');
});

test('manual views are counted and popular manuals are shown on the homepage and brand page', function () {
    $samsung = Brand::create(['name' => 'Samsung']);
    $philips = Brand::create(['name' => 'Philips']);

    $tv = Manual::create([
        'brand_id' => $samsung->id,
        'name' => 'TV',
        'ean' => '1111111',
        'filesize' => 2048,
        'originUrl' => 'https://example.com/tv.pdf',
        'view_count' => 4,
    ]);

    $washer = Manual::create([
        'brand_id' => $samsung->id,
        'name' => 'Wasmachine',
        'ean' => '2222222',
        'filesize' => 4096,
        'originUrl' => 'https://example.com/washer.pdf',
        'view_count' => 2,
    ]);

    $airfryer = Manual::create([
        'brand_id' => $philips->id,
        'name' => 'Airfryer',
        'ean' => '3333333',
        'filesize' => 1024,
        'originUrl' => 'https://example.com/airfryer.pdf',
        'view_count' => 1,
    ]);

    $this->get("/{$samsung->id}/{$samsung->getNameUrlEncodedAttribute()}/{$tv->id}/")->assertOk();

    $this->assertDatabaseHas('manuals', ['id' => $tv->id, 'view_count' => 5]);

    $homeResponse = $this->get('/');
    $homeResponse->assertOk()->assertViewHas('popularManuals', function ($manuals) use ($tv, $washer, $airfryer) {
        return $manuals->pluck('id')->all() === [$tv->id, $washer->id, $airfryer->id]
            && $manuals->first()->brand->name === 'Samsung'
            && $manuals->first()->name === 'TV';
    });

    $brandResponse = $this->get("/{$samsung->id}/{$samsung->getNameUrlEncodedAttribute()}/");
    $brandResponse->assertOk()->assertViewHas('popularBrandManuals', function ($manuals) use ($tv, $washer) {
        return $manuals->pluck('id')->all() === [$tv->id, $washer->id];
    });
});

test('the site language can be switched to Dutch', function () {
    $response = $this->from('/')->get('/language/nl/');

    $response->assertRedirect('/');
    $response->assertSessionHas('locale', 'nl');

    $this->withSession(['locale' => 'nl'])
        ->get('/')
        ->assertSee('Hoofdpagina');
});

test('an invalid contact message is rejected', function () {
    Mail::fake();

    $response = $this->from('/contact')->post('/contact', [
        'name' => '',
        'email' => 'geen-email',
        'subject' => '',
        'message' => '',
    ]);

    $response->assertRedirect('/contact')->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    Mail::assertNothingSent();
});
