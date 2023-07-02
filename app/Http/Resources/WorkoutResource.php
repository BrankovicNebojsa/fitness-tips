<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'workout';

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'workout_duration' => $this->resource->workout_duration,
            'difficulty' => $this->resource->difficulty,
            'description' => $this->resource->description,
            'equipment' => $this->resource->equipment,
            'exercise' => $this->resource->exercise
        ];
    }
}