<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

use Config;

class Event extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'start_date',
		'end_date',
		'time',
		'location',
		'description',
		'file_path',
		'user_id'
	];

	protected $dates = ['start_date', 'end_date', 'time'];

	public function s3_Url() {
		return Storage::disk('s3')->temporaryUrl(
			$this->file_path, now()->addMinutes(20)
		);
	}

	public function user() {
		return $this->belongsTo(User::Class);
	}
}
