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
  <h1>Edit News Article</h1>
  <form action="/news/{{$news_article->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="headline">Headline</label>
      <input type="text" class="form-control" id="headline" value="{{$news_article->headline}}" name="headline" placeholder="Enter headline">
    </div>
    <div class="form-group">
      <label for="body">Body</label>
      <small id="body-text">(Enter body for the news)</small>
      <textarea type="textarea" class="form-control" name="body" id="body" aria-describedby="body-text">
        {{$news_article->body}}
      </textarea>
    </div>
    <div class="form-group">
      <label for="publication_date">Publication Date</label>
      <input type="date" name="publication_date" value="{{$news_article->publication_date->format('Y-m-d')}}" class="form-control" id="publication_date">
    </div>

    <div class="form-group">
      <label for="image">Choose an image:</label>
      <br>
      <input type="file" id="image" name="image" accept="image/jpeg">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
