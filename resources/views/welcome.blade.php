@extends('layouts.app')

@section('content')
	<div class="welcome-text">
		@auth
			Welcome to news and events, {{auth()->user()->name}}!
		@else
			Welcome to news and events
		@endauth
	</div>
	<div class="welcome-banner">
		<img src="/images/banner.jpg" width='100%' alt="news and events" srcset="">
	</div>
	<div class="flex justify-center mt-4 sm:items-center sm:justify-between">
		<div class="text-center text-sm text-gray-500 sm:text-left">
		<div class="flex items-center">
			<a href="/news" class="ml-1">
				Click here to see the News
			</a>

			<a href="/events" class="ml-1">
				Click here to see the upcoming Events
			</a>
		</div>
	</div>
@endsection
