@extends('layouts.app')

@section('content')
	<div id="news">
		<div class="row">
			<div class="col-md-8">
				<h1 class="center">News</h1>
			</div>
			<div class="col-md-4">
				<a class="btn btn-outline-primary" href="/news/create"> Create news article </a>
			</div>
		</div>
		<br/>

		<div class="container-sm">
			@foreach ($news as $news_article)
				<div class="row article">
					<div class="col-4">
						<img src="{{ $news_article->s3_url()}}"
							onerror="this.src = 'https://climate.onep.go.th/wp-content/uploads/2020/01/default-image.png'" alt="image text">
					</div>
					<div class="col-8">
						<a href="{{route('news.show', $news_article->id)}}">
							<h2>{{ $news_article->headline }}</h2>
						</a>
						<p>{{ $news_article->publication_date->format('j M, Y') }} by {{ $news_article->author->name }}</p>
					</div>
					<hr />
				</div>
			@endforeach
		</div>
	</div>
@endsection
