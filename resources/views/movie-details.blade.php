@extends('layouts.mainlayout')
@section ('title', $movie->title)
@section("content")

<link rel="stylesheet" href="{{ asset("css/movie-details.css")}}">
<link rel="stylesheet" href="{{ asset("css/comments.css")}}">
@if ($errors->any())
<div id="error-box">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="row">
    <div class="bg-white col-12 col-md-10 p-4 m-auto" id="movie">

        <div class="row">
        <h2>{{stripslashes($movie->title) }} <span> {{ stripslashes($movie->original_title) }}</span></h2>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                @if ($movie->poster_path)
                <img class="img-fluid" src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{stripslashes($movie->title) }} poster">
                @else
                <br> <!-- Show a stock picture instead -->
                @endif
            </div>
            <div class="col-12 col-md-8" id="recaps">
                @if ($movie->tagline)
                <p class="movie-box">{{stripslashes($movie->tagline)}}</p>
                @endif
                @if ($movie->overview)
                <p class="movie-box">{{stripslashes($movie->overview)}}</p>
                @endif

                <div class="movie-box" id="other-details">
                    <p>Langue Originale : {{$movie->original_language}}</p>
                    <p>Date de Sortie : {{$movie->release_date}}</p>
                    <p>Status : {{$movie->status}}</p>
                    <p>Page Officielle : <a href="{{$movie->homepage}}">{{$movie->homepage}}</a></p>
                    <p>Durée : {{$movie->runtime}} minutes</p>
                    <p>Budget : {{$movie->budget}}$</p>
                    <p>Popularité : {{$movie->popularity}}</p>

                    @if (Auth::check())
                    <div id="add-list-area">
                        <button class="redbtn" id="add-list-btn">Ajouter</button>
                        <form hidden id="add-list-form" method="POST" action="/list/{{Auth::id()}}">
                            @csrf

                            <label for="status">Status : </label>
                            <select name="status" id="field-status">
                                <!-- ne pas changer -->
                                <option value="Vus">Vu</option>
                                <option value="À voir">À voir</option>
                            </select>
                            <label for="rating">Note : </label>
                            <input id="add-list-note" type="text" name="rating" id="field-rating" maxlength="4">
                            <input type="text" name="movie_id" hidden value="{{$movie->id}}">
                            <input type="text" name="user_id" hidden value="{{$current_user->id}}">

                            <button class="redbtn" id="inline-submit-btn" type="submit">Ajouter</button>
                        </form>
                    </div>
                    @endif
                </div>  
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 mb-5">
    <div class=" p-3 bg-white col-12 col-md-10 m-auto ">
        <div class="row  p-3">
            <div class="col">
            <h2>Commentaires</h2>
            <!--TODO: add a way to get the current login user ID, and check if they're connected -->
            @if($current_user)
            <button class="redbtn" id="show-comment-form">Commenter</button>

            <form class="form mt-3" id="comment-form" method="POST" action="/movie/{{$movie->id}}" hidden>
                @csrf
                <textarea class="form-control" rows="5" name="content" id="content"></textarea>
                <br>
                <button class="redbtn" type="submit">Poster</button>
            </form>
            @endif
            </div>
        </div>
    @if(!empty($comments))
    <?php $counter = 0; ?>
    @foreach ($comments as $comment)
    <div class="commentbox row p-2">
        <div class="box col-3 col-md-2" id="user">
            <span> <a href="/profile/{{$comment->username}}">{{$comment->username}}</a></span>
            <span> {{substr($comment->user_created_at, 0, 10)}}</span>
            <img class="img-fluid img-thumbnail" src="{{asset("storage/$comment->avatar")}}" alt="avatar">
            <span>{{$comment->badge}}</span>

        </div>
        <div class="col-md-10 col" id="comment">
            <div class="row">
                <div class="comment-date">
                    <span>Edited: {{$comment->updated_at}}</span>
                    <span>Posted: {{$comment->created_at}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="comment-text">{{html_entity_decode($comment->content)}}</p>
                </div>
            <!-- add a signature ? -->
            </div>
            <div class="row">
                @if(Auth::check())
                    @if(Auth::id() == $comment->user_id || Auth::user()->permissions == "admin")
                    <div class="comments-action col">
                        <form action="/comment/delete" method="post">
                            @csrf
                            <input name="comment_id" type="text" hidden value="{{$comment->id}}">
                        <button class="redbtn" type="submit">Supprimer</button>
                        </form>

                        <button class="redbtn" id="show-comment-form-{{$counter}}" onclick='display({{$counter}})'>Editer</button>
                        
                    </div>
                    
                   <div class="col-12">
                         <form id="comment-form-{{$counter}}" action="/comment/update" method="post" hidden>
                            @csrf
                            <input type="text" hidden value="{{$comment->id}}" name="id">
                            <textarea class="form-control" name="content" id="content" cols="100" rows="10">{{html_entity_decode($comment->content)}}</textarea>
                        <button class="redbtn" type="submit">Valider</button>
                        </form>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        
    </div>
<?php $counter++; ?>
    @endforeach
    @else
    <p class="no-comment">Be the first to comment!</p>
    @endif
    </div>
</div>
@if($current_user)
<script src="{{asset("js/movieDetails.js")}}"></script>
@endif
@endsection
