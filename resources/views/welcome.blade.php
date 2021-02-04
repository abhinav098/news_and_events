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
@endsection
