<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlyCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request) : array
    {
        $createdAt = '';
        if ($this->created_at !== null) {
            $createdAt = Carbon::make($this->created_at)->format('d-m-Y');
        }
        return [
            'name'          => $this->name,
            'description'   => $this->description,
            'uuid'          => $this->uuid,
            'createdAt'     => Carbon::make($createdAt)->format('d/m/Y'),
            'modules'       => OnlyModuleResource::collection($this->whenLoaded('modules'))
        ];
    }
}
