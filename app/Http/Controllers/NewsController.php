<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\News;

class NewsController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		$news;
		if($request->q === 'all'){
			$news = News::latest('created_at')->get();
		} else {
			$news = News::where('user_id', auth()->user()->id)->get();
		}
		return view('news.index', ['news' => $news]);
	}

	public function show(News $news)
	{
		return view('news.show', ['news_article' => $news]);
	}

	public function create()
	{
		return view('news.new');
	}

	public function store(Request $request)
	{
		$validated_params = $this->validateEvent();
		$uploadResponse = $this->uploadToS3($request);
		$upload_filename =  $uploadResponse ?? null;

		$added_params = ['image_path'=>$upload_filename, 'user_id' => auth()->user()->id];
		$all_params = array_merge($validated_params, $added_params);
		News::create($all_params);
		return redirect('/news');
	}

	public function edit(News $news)
	{
		return view('news.edit', ['news_article' => $news]);
	}

	public function update(Request $request, News $news)
	{
		$file_path = $news->image_path;
		if ($request->hasFile('image')) {
			$uploadResponse = $this->uploadToS3($request);
			$file_path =  $uploadResponse ?? null;
		}
		$validated_params = $this->validateEvent();

		$added_params = ['image_path'=>$file_path, 'user_id' => auth()->user()->id];
		$all_params = array_merge($validated_params, $added_params);
		$news->update($all_params);
		return redirect('/news/'.$news->id);
	}

	public function destroy(News $news)
	{
		if ($news->image_path){
			Storage::disk('s3')->delete($news->image_path);
		}
		$news->delete();
		return redirect('/news');
	}

	private function validateEvent() {
    return request()->validate([
      'headline' => 'required|min:5|max:60',
      'body' => 'required|min:20',
      'publication_date' => 'required|date',
			'image' => 'mimes:jpg,jpeg'
		]);
	}

	private function uploadToS3($request) {
		if($request->hasFile('image')){
			$file = $request->file('image');
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
