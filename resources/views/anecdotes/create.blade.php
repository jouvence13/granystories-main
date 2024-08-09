@extends('layouts.app')

@section('content')
    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Soumettre une anecdote</h3>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('anecdote.store') }}" method="POST" class="requires-validation" novalidate>
                            @csrf
                            <div class="col-md-12">
                                <label for="nom">Nom</label>
                                <input class="form-control" type="text" id="nom" name="nom" placeholder="Nom"
                                    required>
                                <div class="valid-feedback">Nom field is valid!</div>
                                <div class="invalid-feedback">Nom field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
                                <label for="prenom">Prénom</label>
                                <input class="form-control" type="text" id="prenom" name="prenom"
                                    placeholder="Prénom" required>
                                <div class="valid-feedback">Prénom field is valid!</div>
                                <div class="invalid-feedback">Prénom field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
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
                                <div class="valid-feedback">You selected a relation!</div>
                                <div class="invalid-feedback">Please select a relation!</div>
                            </div>

                            <div class="col-md-12">
                                <label for="ville">Ville</label>
                                <input class="form-control" type="text" id="ville" name="ville" placeholder="Ville"
                                    maxlength="30" required>
                                <div class="valid-feedback">Ville field is valid!</div>
                                <div class="invalid-feedback">Ville field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
                                <label for="pays">Pays</label>
                                <input class="form-control" type="text" id="pays" name="pays" placeholder="Pays"
                                    maxlength="30" required>
                                <div class="valid-feedback">Pays field is valid!</div>
                                <div class="invalid-feedback">Pays field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
                                <label for="anecdote">Anecdote</label>
                                <textarea class="form-control" id="anecdote" name="anecdote" rows="5" placeholder="Anecdote" required></textarea>
                                <div class="valid-feedback">Anecdote field is valid!</div>
                                <div class="invalid-feedback">Anecdote field cannot be blank!</div>
                            </div>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

        *,
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            -moz-osx-font-smoothing: grayscale;
        }

        html,
        body {
            height: 100%;
            background-color: rgb(177, 111, 25);
            overflow: auto;
            /* Permettre le défilement */
        }

        .form-body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-holder {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
            max-width: 540px;
        }

        .form-holder .form-content {
            position: relative;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .form-content .form-items {
            border: 3px solid #fff;
            padding: 20px;
            display: inline-block;
            width: 100%;
            border-radius: 10px;
            text-align: left;
            transition: all 0.4s ease;
        }

        .form-content h3 {
            color: #fff;
            text-align: left;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-content h3.form-title {
            margin-bottom: 30px;
        }

        .form-content p {
            color: #fff;
            text-align: left;
            font-size: 17px;
            font-weight: 300;
            line-height: 20px;
            margin-bottom: 30px;
        }

        .form-content label,
        .was-validated .form-check-input:invalid~.form-check-label,
        .was-validated .form-check-input:valid~.form-check-label {
            color: #fff;
        }

        .form-content input[type=text],
        .form-content input[type=password],
        .form-content input[type=email],
        .form-content select {
            width: 100%;
            padding: 9px 20px;
            text-align: left;
            border: 0;
            outline: 0;
            border-radius: 6px;
            background-color: #fff;
            font-size: 15px;
            font-weight: 300;
            color: #8D8D8D;
            transition: all 0.3s ease;
            margin-top: 16px;
        }

        .btn-primary {
            background-color: #6C757D;
            outline: none;
            border: 0px;
            box-shadow: none;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: #495056;
            outline: none !important;
            border: none !important;
            box-shadow: none;
        }

        .form-content textarea {
            position: static !important;
            width: 100%;
            padding: 8px 20px;
            border-radius: 6px;
            text-align: left;
            background-color: #fff;
            border: 0;
            font-size: 15px;
            font-weight: 300;
            color: #8D8D8D;
            outline: none;
            resize: none;
            height: 80px;
            transition: none;
            margin-bottom: 14px;
        }

        .form-content textarea:hover,
        .form-content textarea:focus {
            border: 0;
            background-color: #ebeff8;
            color: #8D8D8D;
        }

        .mv-up {
            margin-top: -9px !important;
            margin-bottom: 8px !important;
        }

        .invalid-feedback {
            color: #ff606e;
        }

        .valid-feedback {
            color: #2acc80;
        }
    </style>

    <script>
        (function() {
            'use strict'
            const forms = document.querySelectorAll('.requires-validation')
            Array.from(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')

                        // Scroll to the first invalid field
                        const firstInvalidField = form.querySelector(':invalid');
                        if (firstInvalidField) {
                            firstInvalidField.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    }, false)
                })
        })()
    </script>
@endsection
