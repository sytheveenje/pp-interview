<?php

pest()->group('api');

it('has a valid calculate route', function () {
    $response = $this->post('api/calculate', ['input' => '1+1']);

    $response->assertStatus(200);
});

it('returns an error if no input is provided', function() {
    $response = $this->post('api/calculate');

    $response->assertStatus(302);
    $response->assertSessionHasErrors('input');
});

it('returns an error when an invalid input is provided', function() {
    $response = $this->post('api/calculate', ['input' => '1+']);

    $response->assertStatus(302);
    $response->assertJsonFragment(['error' => 'Incorrect expression']);
});

it('returns an error when an invalid operator is provided', function() {
    $response = $this->post('api/calculate', ['input' => '1+test']);

    $response->assertStatus(302);
    $response->assertSessionHasErrors('input');
});

it('can take an input as a string', function() {
    $response = $this->post('api/calculate', ['input' => '31.5']);

    $response->assertStatus(200);
    $response->assertJsonFragment(['input' => '31.5']);
});

it('returns a result', function() {
    $response = $this->post('api/calculate', ['input' => '1+1']);

    $response->assertStatus(200);
    $response->assertJsonStructure(['result']);
});
