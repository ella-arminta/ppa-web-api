<?php

namespace App\Http\Resources\DetailKlien;

use App\Models\DetailKlien\KategoriKasus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategoriKasusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = new KategoriKasus();

        return $model->resourceData($this);
        //return parent::toArray($request);
    }
}