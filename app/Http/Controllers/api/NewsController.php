<?php

namespace App\Http\Controllers\api;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\News as NewsResource;
use App\Http\Resources\NewsCollection;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

	public function index(Request $request)
	{
		$query = trim($request->q);
		return new NewsCollection(News::where('headline', 'like', '%'.$query.'%')->latest('publication_date')->get());
	}

	public function show($id)
	{
			return new NewsResource(News::findOrFail($id));

	}
}
