@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Anecdotes</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($anecdotes as $anecdote)
            <div class="anecdote">
                <h2>{{ $anecdote->nom }}</h2>
                <p><strong>Prénom :</strong> {{ $anecdote->prenom }}</p>
                <p><strong>Relation :</strong> {{ $anecdote->relation }}</p>
                <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($anecdote->date)->format('d/m/Y') }}</p>
                <p><strong>Ville, Pays :</strong> {{ $anecdote->ville }}, {{ $anecdote->pays }}</p>
                <p><strong>Anecdote :</strong>{{ $anecdote->anecdote }}</p>
            </div>
        @endforeach
    </div>
@endsection
