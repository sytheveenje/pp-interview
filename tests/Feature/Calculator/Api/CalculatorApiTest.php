<?php

pest()->group('api');

it('has a valid calculate route', function () {
    $response = $this->post('api/calculate');

    $response->assertStatus(200);
    $response->assertJsonFragment(['input' => null]);
});

it('can take an input as a string', function() {
    $response = $this->post('api/calculate/31.5');

    $response->assertStatus(200);
    $response->assertJsonFragment(['input' => '31.5']);
});

it('can calculate the result', function() {
    $response = $this->post('api/calculate/31.5');

    $response->assertStatus(200);
    $response->assertJsonStructure(['result']);
    $this->assertIsNumeric($response->json('result'));
});
