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
            <select class="form-control" id="relation" name="relation" required>
                <option value="Enfants">Enfants</option>
                <option value="Petits-enfants">Petits-enfants</option>
                <option value="Gendres/Brue">Gendres/Brue</option>
                <option value="Famille">Famille</option>
                <option value="Belle Famille">Belle Famille</option>
                <option value="Amis">Amis</option>
                <option value="Connaissance">Connaissance</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" maxlength="30" required>
        </div>
        <div class="form-group">
            <label for="pays">Pays</label>
            <input type="text" class="form-control" id="pays" name="pays" maxlength="30" required>
        </div>
        <div class="form-group">
            <label for="anecdote">Anecdote</label>
            <textarea class="form-control" id="anecdote" name="anecdote" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>
@endsection
