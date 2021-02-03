<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->user = Auth::user();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$events = Event::latest('id')->get();
		return view('events.index', ['events' => $events]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('events.new');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validated_params = $this->validateEvent();
		$uploadResponse = $this->uploadToS3($request);
		$upload_filename =  $uploadResponse ?? null;

		$added_params = ['file_path'=>$upload_filename, 'user_id' => auth()->user()->id];
		$all_params = array_merge($validated_params, $added_params);
		Event::create($all_params);
		return redirect('/events');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function show(Event $event)
	{
		return view('events.show', ['event' => $event ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Event $event)
	{
		return view('events.edit', ['event' => $event]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Event $event)
	{
		$validated_params = $this->validateEvent();
		$uploadResponse = $this->uploadToS3($request);
		$upload_filename =  $uploadResponse ?? null;
		$upload_filename = $request->hasFile('file') ? $upload_filename : $event->file_path;

		$added_params = ['file_path'=>$upload_filename, 'user_id' => auth()->user()->id];
		$all_params = array_merge($validated_params, $added_params);
		$event->update($all_params);
		return redirect('/events');
		return redirect('/events/'.$event->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Event $event)
	{
		//
	}

	private function validateEvent() {
    // 'request()->validate()' returns validated attributes if validations pass
    return request()->validate([
      'title' => 'required|min:5',
      'description' => 'required',
      'start_date' => 'required|date|after:now()',
			'end_date' => 'required|date|after_or_equal:start_date',
      'time' => 'required',
			'location' => 'required',
			"file" => "mimetypes:application/pdf|max:10000"
		]);
	}

	private function uploadToS3($request) {
		if($request->hasFile('file')){
			$file = $request->file('file');
			$extension = $file->getClientOriginalExtension();
			$filename = time().Str::random(10).'.'.$extension;
			$s3 = Storage::disk('s3');
			if($s3->put($filename, file_get_contents($file))){
				return $filename;
			} else {
				return false;
			}
		}
	}
}
