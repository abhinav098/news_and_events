@extends('layouts.app')

@section('content')
  @if ($errors->any())
    <div style="color:red" class="alert alert-danger">
      <h3>Your submission has the following errors:</h3>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
    </div>
  @endif
  <h1>New Event</h1>
  <form action="/events" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" value="{{old('title')}}" name="title" placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <small id="description-text">(Enter description for the event)</small>
      <textarea type="textarea" class="form-control" name="description" id="description" aria-describedby="description-text">{{old('description')}}</textarea>
    </div>
    <div class="form-group">
      <label for="start_date">Start Date</label>
      <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control" id="start_date">
    </div>
    <div class="form-group">
      <label for="end_date">End Date</label>
      <input type="date" name="end_date" value="{{old('end_date')}}" class="form-control" id="end_date">
    </div>
    <div class="form-group">
      <label for="time">Time</label>
      <input type="time" name="time" class="form-control" value="{{old('time')}}" id="time">
    </div>

    <div class="form-group">
      <label for="location">Location</label>
      <input type="text" name="location" value="{{old('location')}}" class="form-control" id="location">
    </div>

    <div class="form-group">
      <label for="attachment">Choose an attachment:</label>
      <br>
      <input type="file" id="attachment" name="file" accept="application/pdf">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
