@extends('layouts.app')

@section('content')
	<div id="events">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8">
							<h1 class="center">Events</h1>
						</div>
						<div class="col-md-4">
							<a class="btn btn-outline-primary" href="/events/create"> Create new Event </a>
						</div>
					</div>
					<br/>
					<div class="event-listings">
						<div class="container-sm">
							<div class="row">
								@foreach ($events as $event)
									<div class="event col-md-8">
										<a href="{{route('events.show', $event)}}">
											<h2>{{ $event->title }}</h2>
											<p>{{$event->start_date->format('j F, Y') }} to {{$event->end_date->format('j F, Y') }} at {{$event->time->format('H:i') }}</p>
											<p>{{ $event->location }}</p>
										</a>
									</div>
									<hr />
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
