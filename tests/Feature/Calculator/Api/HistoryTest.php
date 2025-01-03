<?php

use App\Models\Calculation;
use Carbon\Carbon;

pest()->group('history');

it('has a valid api route to get the history', function () {
    $response = $this->get('/api/calculations');

    $response->assertStatus(200);
});

it('returns an empty array if no history is available', function () {
    $response = $this->get('/api/calculations');

    $response->assertStatus(200);
    $response->assertJson([]);
});

it('returns the history of calculations', function () {
    Calculation::factory()->create([
        'input' => '2+2',
        'result' => 4,
        'created_at' => '2024-01-01 12:00:00',
    ]);

    $response = $this->get('/api/calculations');

    $response->assertStatus(200);
    $response->assertJson([
        [
            'date' => '2024-01-01',
            'calculations' => [
                [
                    'id' => 1,
                    'input' => '2+2',
                    'result' => 4,
                    'created_at' => '2024-01-01T12:00:00.000000Z',
                ],
            ],
        ],
    ]);
});

it('returns the history of calculations grouped by date', function () {

    Calculation::factory()->create([
        'input' => '2+2',
        'result' => 4,
        'created_at' => '2024-01-01 12:00:00',
    ]);

    Calculation::factory()->create([
        'input' => '4+4',
        'result' => 8,
        'created_at' => '2024-01-02 12:00:00',
    ]);

    $response = $this->get('/api/calculations');

    $response->assertStatus(200);
    $response->assertJson([
        [
            'date' => '2024-01-02',
            'calculations' => [
                [
                    'id' => 2,
                    'input' => '4+4',
                    'result' => 8,
                    'created_at' => '2024-01-02T12:00:00.000000Z',
                ],
            ],
        ],
        [
            'date' => '2024-01-01',
            'calculations' => [
                [
                    'id' => 1,
                    'input' => '2+2',
                    'result' => 4,
                    'created_at' => '2024-01-01T12:00:00.000000Z',
                ],
            ],
        ],
    ]);
});

it('can delete a calculation', function () {
    Calculation::factory()->create([
        'input' => '2+2',
        'result' => 4,
        'created_at' => '2024-01-01 12:00:00',
    ]);

    $response = $this->delete('/api/calculations/1');

    $response->assertStatus(204);
    $this->assertDatabaseMissing('calculations', [
        'id' => 1,
    ]);
});

it('returns a 404 if the calculation does not exist', function () {
    $response = $this->delete('/api/calculations/1');

    $response->assertStatus(404);
});

it('can destroy all calculations', function () {
    Calculation::factory()->create([
        'input' => '2+2',
        'result' => 4,
        'created_at' => '2024-01-01 12:00:00',
    ]);

    Calculation::factory()->create([
        'input' => '4+4',
        'result' => 8,
        'created_at' => '2024-01-02 12:00:00',
    ]);

    $response = $this->delete('/api/calculations');

    $response->assertStatus(204);
    $this->assertDatabaseCount('calculations', 0);
});
