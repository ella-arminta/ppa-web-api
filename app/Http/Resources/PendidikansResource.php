<?php

namespace App\Http\Resources;

use App\Models\Pendidikans;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendidikansResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = new Pendidikans();

        return $model->resourceData($this);
        //return parent::toArray($request);
    }
}