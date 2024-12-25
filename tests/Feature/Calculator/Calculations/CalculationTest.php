<?php

pest()->group('calculations');

it('can calculate the sum of two numbers', function () {
    $response = $this->post('/api/calculate/', [
        'input' => '1+2',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'result' => 3,
    ]);
});

it('can calculate the difference of two numbers', function () {
    $response = $this->post('/api/calculate/', [
        'input' => '5-2',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'result' => 3,
    ]);
});

it('can calculate the product of two numbers', function () {
    $response = $this->post('/api/calculate/', [
        'input' => '3*4',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'result' => 12,
    ]);
});

it('can calculate the quotient of two numbers', function () {
    $response = $this->post('/api/calculate/', [
        'input' => '10/2',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'result' => 5,
    ]);
});

it('can calculate the square root of a number', function () {
    $response = $this->post('/api/calculate/', [
        'input' => 'sqrt(9)',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'result' => 3,
    ]);
});

it('can calculate the square/power of a number', function () {
    $response = $this->post('/api/calculate/', [
        'input' => '2^2',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'result' => 4,
    ]);
});

it('can calculate the stretch goal expression', function () {
    $response = $this->post('/api/calculate/', [
        'input' => 'sqrt(((((9*9)/12)+(13-4))*2)^2)',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'result' => 31.5,
    ]);
});