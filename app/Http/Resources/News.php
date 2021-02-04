<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
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
			'headline'       => $this->headline,
			'image_url'    => $this->s3_url() ?? '',
			'publication_date'     => $this->publication_date,
			'body' => $this->body,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			"author" => $this->author->name,
		];
	}
}
