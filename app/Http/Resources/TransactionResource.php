<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Nombre' => $this->resource->user?->full_name,
            'Movimiento' => $this->resource->operation->name,
            'Importe' => $this->resource->amount,
            'Estado' => $this->resource->status,
            'Fecha' => $this->resource->created_at->format('Y-m-d')
        ];
    }
}
