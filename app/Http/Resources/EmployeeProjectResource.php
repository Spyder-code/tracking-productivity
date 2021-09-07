<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeProjectResource extends JsonResource
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
            'project_id' => new ProjectResource(Project::find($this->project_id)),
            'total_time' => $this->total_time,
        ];
    }
}
