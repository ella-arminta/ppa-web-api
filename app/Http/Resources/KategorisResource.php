<?php

namespace App\Http\Resources;

use App\Models\Kategoris;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategorisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = new Kategoris();

        return $model->resourceData($this);
        //return parent::toArray($request);
    }
}