<?php

namespace App\Http\Controllers\api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\Event as EventResource;
use App\Http\Resources\EventsCollection;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{

	public function index(Request $request)
	{
		$query = trim($request->q);
		return new EventsCollection(Event::where('title', 'like', '%'.$query.'%')->orderBy('start_date', "ASC")->get());
	}

	public function show($id)
	{
			return new EventResource(Event::findOrFail($id));

	}
}
