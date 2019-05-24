<?php

namespace Nova\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $user = auth()->user();

        return [
            'can' => [
                'delete' => gate()->allows('delete', $this->resource),
                'update' => gate()->allows('update', $this->resource),
            ],
            'email' => $this->email,
            'id' => $this->id,
            'name' => $this->name,
            'roles' => $this->getRoles(),
        ];
    }
}
