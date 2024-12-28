<?php

namespace App\Actions\Calculations;

use App\Models\Calculation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCalculationsFromDatabase
{
    use AsAction;

    /**
     * Get calculations from database, grouped by date
     * used for showing history
     *
     * @return Collection
     */
    public function handle()
    {
        return Calculation::query()
            ->select('id', 'input', 'result', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->map(function ($items, $date) {
                return [
                    'date' => $date,
                    'calculations' => $items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'input' => $item->input,
                            'result' => $item->result,
                            'created_at' => $item->created_at,
                        ];
                    })->values(),
                ];
            })->values();
    }
}
