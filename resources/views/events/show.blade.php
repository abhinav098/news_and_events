@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>{{ $event->title }}</h3>
				<p>Start Date: {{$event->start_date->format('j F, Y') }}</p>
				<p>End Date: {{$event->end_date->format('j F, Y') }}</p>
				<p>Time: {{$event->time->format('H:i') }}</p>
				<p>{{ $event->description }}</p>
				<p>{{ $event->location }}</p>
				<form action="/events/{{$event->id}}" method="POST">
					@csrf
					@method('DELETE')
					<a class="btn btn-primary" href="/events/{{$event->id}}/edit">Edit</a>
					<button type='submit' class='btn btn-danger'>Delete</button>
					@if($event->file_path)
						<a class="btn btn-secondary" href="{{$event->s3_Url()}}" target="_blank" download>
							Download {{ $event->file_path }}
						</a>
					@endif
				</form>
			</div>
			{{-- <a href="/events/{{$event->id}}/edit">Destroy</a> --}}
		</div>

	</div>

@endsection
