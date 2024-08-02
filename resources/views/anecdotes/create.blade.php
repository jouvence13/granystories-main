@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Soumettre une anecdote</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
<form action="{{ route('anecdote.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" required>
    </div>
    <div class="form-group">
        <label for="relation">Lien</label>
        <select class="form-control" name="relation" id="relation" required>
            @foreach ($liens as $lien)
                <option value="{{$lien}}">{{$lien}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="form-group">
        <label for="ville">Ville</label>
        <select class="form-control" name="ville" id="ville" required>
            @foreach ($cities as $city)
                <option value="{{$city}}">{{$city}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="pays">Pays</label>
        <select class="form-control" name="pays" id="pays" required>
             @foreach ($countries as $country)
                 <option value="{{$country}}">{{$country}}</option>
             @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="anecdote">Anecdote</label>
        <textarea class="form-control" id="anecdote" name="anecdote" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
@endsection
