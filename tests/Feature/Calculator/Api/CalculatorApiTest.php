<?php

use App\Enums\CalculatorError;

pest()->group('api');

it('has a valid calculate route', function () {
    $response = $this->post('api/calculate', ['input' => '1+1']);

    $response->assertStatus(200);
});

it('returns an error if no input is provided', function() {
    $response = $this->postJson('api/calculate');

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('input');
    $response->assertJsonFragment(['message' => CalculatorError::INPUT_REQUIRED->value]);
});

it('returns an error when the input is too long', function() {
    $response = $this->postJson('api/calculate', ['input' => str_repeat('1', 256)]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('input');
    $response->assertJsonFragment(['message' => CalculatorError::INPUT_MAX->value]);
});

it('returns an error when the input is not a string', function() {
    $response = $this->postJson('api/calculate', ['input' => 1]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('input');
    $response->assertJsonFragment(['message' => CalculatorError::INPUT_STRING->value]);
});

it('returns an error when an invalid input is provided', function() {
    $response = $this->post('api/calculate', ['input' => '1+']);

    $response->assertStatus(302);
    $response->assertJsonFragment(['error' => CalculatorError::INCORRECT_EXPRESSION]);
});

it('returns an error when an invalid variable is provided', function() {
    $response = $this->post('api/calculate', ['input' => '1+test']);

    $response->assertStatus(302);
    $response->assertJsonFragment(['error' => CalculatorError::UNKNOWN_VARIABLE]);
});

it('returns an error when an invalid operator is provided', function() {
    $response = $this->post('api/calculate', ['input' => '1=2']);

    $response->assertStatus(302);
    $response->assertJsonFragment(['error' => CalculatorError::UNKNOWN_OPERATOR]);
});

it('returns an error when an invalid bracket is provided', function() {
    $response = $this->post('api/calculate', ['input' => '1+(2']);

    $response->assertStatus(302);
    $response->assertJsonFragment(['error' => CalculatorError::INCORRECT_BRACKETS]);
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
