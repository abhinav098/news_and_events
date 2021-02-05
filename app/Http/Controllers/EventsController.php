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
	public const LOCATIONS = [
		'Alabama (AL)', 'Alaska (AK)', 'American Samoa (AS)', 'Arizona (AZ)', 'Arkansas (AR)',
		'California (CA)', 'Colorado (CO)', 'Connecticut (CT)', 'Delaware (DE)', 'District of Columbia (DC)',
		'States of Micronesia (FM)', 'Florida (FL)', 'Georgia (GA)', 'Guam (GU)', 'Hawaii (HI)', 'Idaho (ID)',
		'Illinois (IL)', 'Indiana (IN)', 'Iowa (IA)', 'Kansas (KS)', 'Kentucky (KY)', 'Louisiana (LA)', 'Maine (ME)',
		'Marshall Islands (MH)', 'Maryland (MD)', 'Massachusetts (MA)', 'Michigan (MI)', 'Minnesota (MN)', 'Mississippi (MS)',
		'Missouri (MO)', 'Montana (MT)', 'Nebraska (NE)', 'Nevada (NV)', 'New Hampshire (NH)', 'New Jersey (NJ)',
		'New Mexico (NM)', 'New York (NY)', 'North Carolina (NC)', 'North Dakota (ND)', 'Northern Mariana Islands (MP)', 'Ohio (OH)', 'Oklahoma (OK)', 'Oregan (OR)', 'Palau (PW)', 'Pennsilvania (PA)', 'Puerto Rico (PR)', 'Rhode Island (RI)', 'South Carolina (SC)', 'South Dakota (SD)', 'Tennessee (TN)', 'Texas (TX)', 'Utah (UT)', 'Vermont (VT)', 'Virgin Islands (VI)', 'Virginia (VA)', 'Washington (WA)', 'West Virginia (WV)', 'Wisconsin (WI)', 'Wyoming (WY)'
	];

	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$events;
		if($request->q === 'all'){
			$events = Event::latest('created_at')->get();
		} else {
			$events = Event::where('user_id', auth()->user()->id)->get();
		}
		return view('events.index', ['events' => $events]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('events.new', ['locations' => EventsController::LOCATIONS]);
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
		$event = Event::create($all_params);
		return redirect('/events/'.$event->id);
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
		return view('events.edit', ['event' => $event, 'locations' => EventsController::LOCATIONS]);
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
		$file_path = $event->file_path;
		if ($request->hasFile('file')) {
			$uploadResponse = $this->uploadToS3($request);
			$file_path =  $uploadResponse ?? null;
		}
		$validated_params = $this->validateEvent();
		$added_params = ['file_path'=>$file_path, 'user_id' => auth()->user()->id];
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
		if ($event->file_path){
			Storage::disk('s3')->delete($event->file_path);
		}
		$event->delete();
		return redirect('/events');
	}

	private function validateEvent() {
    // 'request()->validate()' returns validated attributes if validations pass
    return request()->validate([
      'title' => 'required|min:5|max:60',
      'description' => 'required|min:20',
      'start_date' => 'required|date|after_or_equal:today',
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
