<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => new UserResource(User::find($this->user_id)),
            'name' => $this->name,
            'description' => $this->description,
            'code' => $this->code,
            'status' => $this->status,
        ];
    }
}
