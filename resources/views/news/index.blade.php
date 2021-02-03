@extends('layouts.app')

@section('content')
	<div id="news">
		<div class="row">
			<div class="col-md-8">
				<h1 class="center">News</h1>
			</div>
			<div class="col-md-4">
				<button>
					<a href="/news/create"> Create a news article </a>
				</button>
			</div>
		</div>
		<br/>
		@foreach ($news as $news_article)
			<br />
			<a href="{{route('news.show', $news_article->id)}}">
				<div class="card">
					<div class="card-header">
						{{ $news_article->headline }}
						<p>{{ $news_article->publication_date }}</p>
					</div>
					<div class="card-body">
						<p>{{ $news_article->author->name }}</p>
						<p>{{ $news_article->body }}</p>
					</div>
				</div>
			</a>
		@endforeach
	</div>
@endsection
