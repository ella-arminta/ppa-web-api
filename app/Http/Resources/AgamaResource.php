<?php

namespace App\Http\Resources;

use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgamaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = new Agama();

        return $model->resourceData($this);
        //return parent::toArray($request);
    }
}