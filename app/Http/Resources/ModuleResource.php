<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    public function toArray($request)
    {
        $createdAt = '';
        if ($this->created_at !== null) {
            $createdAt = Carbon::make($this->created_at)->format('d-m-Y');
        }

        return [
            'name'          => $this->name,
            'course_id'     => $this->course_id,
            'uuid'          => $this->uuid,
            'createdAt'     => Carbon::make($createdAt)->format('d/m/Y'),
            'lessons'       => LessonResource::collection($this->whenLoaded('lessons'))
        ];
    }
}
