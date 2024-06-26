@extends('layouts.mainlayout')
<!-- USE JOIN TABLE -->
@section("content")

<link rel="stylesheet" href="{{ asset("css/movie-details.css")}}">
<link rel="stylesheet" href="{{ asset("css/comments.css")}}">
    <div id="movie-details">
    <h2>{{ stripslashes($movie->title) }}  <span> {{ stripslashes($movie->original_title) }}</span></h2>

      <div id="up">
      @if ($movie->poster_path)
        <img class="movie-poster" src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ stripslashes($movie->title) }} poster">
      @else
          <br> <!-- Show a stock picture instead -->
      @endif
      <div id="recaps">
        @if ($movie->tagline)
        <p>{{stripslashes($movie->tagline)}}</p>
      @endif
      @if ($movie->overview)
        <p>{{stripslashes($movie->overview)}}</p>
      @endif
     
      <div id="bottom">
        <p>Langue Originale : {{$movie->original_language}}</p>
        <p>Date de Sortie : {{$movie->release_date}}</p>
        <p>Status : {{$movie->status}}</p>
        <p>Page Officielle : <a href="{{$movie->homepage}}">{{$movie->homepage}}</a></p>
        <p>Durée : {{$movie->runtime}} minutes</p>
        <p>Budget : {{$movie->budget}}$</p>
        <p>Popularité : {{$movie->popularity}}</p>
      </div>  
      </div>
      </div>
    </div>


    <div id="comments-list">
      <h2>Commentaires</h2>
      <!--TODO: add a way to get the current login user ID, and check if they're connected -->
      @if($current_user)  
        <button id="show-comment-form">Commenter</button>
        @if ($errors->any())
        <div id="error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        </div>
        @endif
        <form id="comment-form" method="POST" action="/movie/{{$movie->id}}" hidden>
          @csrf
          <textarea name="content" id="content" cols="100" rows="10"></textarea>
          <br>
          <input type="submit" value="Poster">
        </form>
      @endif

      @if ($comments)
        @foreach ($comments as $comment)
          <div class="comment">
            <div class="user-info">
              <span class="username"> {{$comment->username}}</span>
              <span  class=""> {{substr($comment->user_created_at, 0, 10)}}</span>
              <img src="" alt="avatar">
              <span>{{$comment->badge}}</span>
            </div>
            <div class="user-comment">
              <div class="comment-date">
                <span>Posted: {{$comment->created_at}}</span>
                <span>Edited: {{$comment->updated_at}}</span>
              </div>
              <pre class="comment-text">{{html_entity_decode($comment->content)}}</pre>
              <!-- add a signature ? -->
              
            </div>
          </div>
        @endforeach
      @else
          <p class="no-comment">Be the first to comment!</p>
      @endif
    </div>
    @if($current_user)  
      <script src="{{asset("js/movieDetails.js")}}"></script>
    @endif
@endsection