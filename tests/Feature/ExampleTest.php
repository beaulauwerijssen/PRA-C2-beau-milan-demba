<?php

use Illuminate\Support\Facades\Mail;

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('the contact and about footer routes return a successful response', function () {
    $this->get('/contact')->assertStatus(200);
    $this->get('/over-ons')->assertStatus(200);
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
