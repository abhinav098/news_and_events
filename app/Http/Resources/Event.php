<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
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
      'id'         => $this->id,
      'title'       => $this->title,
      'start_date'    => $this->start_date,
			'end_date'     => $this->end_date,
			'time'				=> $this->time,
			'location'		=> $this->location,
      'description' => $this->description,
      'file_url' => $this->s3_url() ?? '',
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
	}
}
