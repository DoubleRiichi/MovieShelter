@extends('layouts.mainlayout')

@section("content")

<link rel="stylesheet" href="{{asset("css/search.css")}}">

<div id="search-area">
    <form id="search-form" method="POST" action="/search/">
        @csrf
        <div id="up">
            <label for="title">Titre : </label>
            <input type="text" name="title" id="" size="50"> 
        </div>
        <div id="middle">    
            <label for="beforeDate">Avant : </label>
            <input type="date" name="beforeDate" id=""> 
            <label for="afterDate">Après : </label>
            <input type="date" name="afterDate" id="">
        </div>
        <div id="down">
            <label for="minimumRating">Note : </label>
            <input type="text" name="minimumRating" id="" size="1">
            <label for="minimumPopularity">Popularité : </label>
            <input type="text" name="minimumPopularity" size="1">
            <label for="minimumBudget">Budget : </label>
            <input type="text" name="minimumBudget" id="" size="1">
        </div>
        <br>
        <input type="submit" value="Chercher">
    </form>

    @if(isset($results))
    <div id="search-results">
        <table>
            <caption>
                Résultats
            </caption>
            <thead>
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Date de sortie</th>
                <th scope="col">Budget</th>
                <th scope="col">Popularité</th>
                <th scope="col">Note</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($results as $movie)
            <tr>
                <th scope="row"><a class="movie-link" href="/movie/{{$movie->id}}">{{stripslashes($movie->title)}}</a></th>
                <td>{{$movie->release_date}}</td>
                <td>{{$movie->budget}}</td>
                <td>{{$movie->popularity}}</td>
                <td>0</td>
            </tr>   
        @endforeach
            </tbody>
            <tfoot>
                <tr>
                <th scope="row" colspan="4">Nombre de Résultats</th>
                <td>{{count($results)}}</td>
                </tr>
            </tfoot>
        </table>

    </div>
    @endif
<br>
    @if ($errors->any())
    <div id="error-box">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
</div>



<script src="{{asset("js/search.js")}}"></script>
@endsection