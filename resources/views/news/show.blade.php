@extends('layouts.app')

@section('content')
	<div id="news">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h1>{{ $news_article->headline }}</h1>
					<p>Published on: {{$news_article->publication_date->format('j F, Y') }}</p>
					<p>
						<form action="/news/{{$news_article->id}}" method="POST">
							@csrf
							@method('DELETE')
							<a class="btn btn-primary" href="/news/{{$news_article->id}}/edit">Edit</a>
							<button type='submit' class='btn btn-danger'>Delete</button>
						</form>
					</p>
					@if ($news_article->image_path)
						<img src="{{ $news_article->s3_url()}}" height="50%" alt="" srcset="">
					@endif
					<br>
					<br>
					<p>{{ $news_article->body }}</p>
				</div>
			</div>
		</div>
	</div>
@endsection
