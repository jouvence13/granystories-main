@extends('layouts.app')

@section('content')
<style>
    .container {
        border: 1px solid #ccc;
        padding: 20px;
        margin-top: 20px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    h1 {
        color: #ffffff;
        font-size: 24px;
        margin-bottom: 20px;
    }

    p {
        color: #ffffff;
        font-size: 16px;
        margin-bottom: 10px;
    }

    strong {
        color: #ffffff;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #FFFFFF;
        color: #007bff;
        border-color: #0056b3;
    }
</style>

<body style="background-color: black; ">
    <div class="container">
        <h1>Anecdote de {{ $anecdote->nom }} {{ $anecdote->prenom }}</h1>
        <p><strong>Lien :</strong> {{ $anecdote->relation }}</p>
        <p><strong>Ville :</strong> {{ $anecdote->ville }}</p>
        <p><strong>Pays :</strong> {{ $anecdote->pays }}</p>
        <p><strong>Anecdote :</strong> {{ $anecdote->anecdote }}</p>
        <a href="/" class="btn btn-primary">Voir le livre</a>
    </div>
</body>
@endsection
