<?php

namespace App\Http\Resources;

use App\Models\SumberPengaduan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SumberPengaduanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = new SumberPengaduan();

        return $model->resourceData($this);
        //return parent::toArray($request);
    }
}