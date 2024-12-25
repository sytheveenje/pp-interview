<?php

pest()->group('api');

it('has a valid calculate route', function () {
    $response = $this->post('api/calculate/1+1');

    $response->assertStatus(200);
});

it('returns an error if no input is provided', function() {
    $response = $this->post('api/calculate');

    $response->assertStatus(400);
    $response->assertJsonFragment(['error' => 'Input is required']);
});

it('can take an input as a string', function() {
    $response = $this->post('api/calculate/31.5');

    $response->assertStatus(200);
    $response->assertJsonFragment(['input' => '31.5']);
});

it('can calculate a result', function() {
    $response = $this->post('api/calculate/1+1');

    $response->assertStatus(200);
    $response->assertJsonFragment(['result' => 2]);
});
