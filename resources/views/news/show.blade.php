@extends('layouts.app')

@section('content')
	<div id="news">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h3>{{ $news_article->headline }}</h3>
					<p>Published on: {{$news_article->publication_date->format('j F, Y') }}</p>

					@if ($news_article->image_url)
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
