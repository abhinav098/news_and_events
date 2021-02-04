@extends('layouts.app')

@section('content')
  @if ($errors->any())
    <div style="color:red" class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <h1>Edit Event</h1>
  <form action="/events/{{$event->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <small id="description-text">(Enter description for the event)</small>
      <textarea type="textarea" class="form-control" name="description" id="description" aria-describedby="description-text">{{ $event->description }}</textarea>
    </div>
    <div class="form-group">
      <label for="start_date">Start Date</label>
      <input type="date" name="start_date" value="{{ $event->start_date->format('Y-m-d') }}" class="form-control" id="start_date">
    </div>
    <div class="form-group">
      <label for="end_date">End Date</label>
      <input type="date" name="end_date" value="{{ $event->end_date->format('Y-m-d') }}" class="form-control" id="end_date">
    </div>
    <div class="form-group">
      <label for="time">Time</label>
      <input type="time" name="time" value="{{ $event->time->format('H:i') }}" class="form-control" id="time">
    </div>

    <div class="form-group">
      <label for="location">Location</label>
      <select class="form-control" id="location" name="location" required focus>
        <option value="" disabled selected>Select Location</option>
        @foreach($locations as $location)
          <option value="{{$location}}" @if($event->location == $location) selected  @endif>{{ $location }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label class="uploaded-file-name">Uploaded file: {{ $event->file_path }}</label>
    </div>
    <div class="form-group">
      <label for="attachment">Choose an attachment:</label>
      <br>
      <input type="file" id="attachment" name="file" accept="application/pdf" aria-describedby="file-name">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
