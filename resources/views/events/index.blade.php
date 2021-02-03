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
							<button>
								<a href="/events/create"> Create an Event </a>
							</button>
						</div>
					</div>
					<br/>
					<div class="listings">
						<div class="container-sm">
							<div class="row row-cols-3">
								@foreach ($events as $event)
									<br />
									<a href="{{route('events.show', $event)}}">
										<div class="card">
											<div class="card-header">
												{{ $event->title }}
												<br>
												{{$event->start_date->format('j F, Y') }} - {{$event->end_date->format('j F, Y') }}
												<br>
												{{$event->time->format('H:i') }}
											</div>
											<div class="card-body">
												<p>{{ $event->location }}</p>
												<p>{{ $event->description }}</p>
											</div>
										</div>
										<br>
									</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
