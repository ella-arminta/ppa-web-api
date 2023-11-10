<?php

namespace App\Http\Resources\DetailKlien;

use App\Models\DetailKlien\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PekerjaanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = new Pekerjaan();

        return $model->resourceData($this);
        //return parent::toArray($request);
    }
}