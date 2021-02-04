<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Config;
class News extends Model
{
	use HasFactory;

	protected $fillable = [
		'headline',
		'publication_date',
		'user_id',
		'body',
		'image_path'
	];

	protected $dates = ['publication_date'];

	public function author() {
		return $this->belongsTo(User::Class, 'user_id');
	}

	public function s3_Url() {
		if ($this->image_path) {
			return Storage::disk('s3')->temporaryUrl(
				$this->image_path, now()->addMinutes(5)
			);
		}
	}
}
