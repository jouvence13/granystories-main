@extends('layouts.app')

@section('content')
    <style>
        .container {
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        h1 {
            color: #ffffff;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
        }

        p {
            color: #e0e0e0;
            font-size: 18px;
            margin-bottom: 10px;
            line-height: 1.6;
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
            display: inline-block;
            transition: background-color 0.3s ease, color 0.3s ease;
            box-shadow: 0px 4px 15px rgba(0, 123, 255, 0.2);
        }

        .btn-primary:hover {
            background-color: #ffffff;
            color: #007bff;
            border-color: #0056b3;
        }

        .container a.btn-primary {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }

        body {
            background-color: rgb(177, 111, 25);
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <body>
        <div class="container">
            <h1>Anecdote de {{ $anecdote->nom }} {{ $anecdote->prenom }}</h1>
            <p><strong>Lien :</strong> {{ $anecdote->relation }}</p>
            <p><strong>Ville :</strong> {{ $anecdote->ville }}</p>
            <p><strong>Pays :</strong> {{ $anecdote->pays }}</p>
            <p><strong>Anecdote :</strong> {!! $anecdote->anecdote !!}</p>
            <a href="/" class="btn btn-primary">Voir le livre</a>
        </div>
    </body>
@endsection
