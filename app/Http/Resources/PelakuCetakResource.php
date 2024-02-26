<?php

namespace App\Http\Resources;

use App\Models\Pelaku;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PelakuCetakResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = new Pelaku();

        return $model->resourceDataCetak($this);
    }
}
