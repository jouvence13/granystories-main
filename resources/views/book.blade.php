<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'anecdotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background-color:  rgb(177, 111, 25);">
    <div class="book-container">
        <div id="book" class="book">
            <!-- Page 1 - Image de couverture -->
            <div id="p1" class="paper">
                <div class="front">
                    <div id="f1" class="front-content">
                        <img class="img-fluid" style="object-fit: cover;width:100%;"
                            src="{{ asset('image/homebook.png') }}" alt="Couverture">
                    </div>
                </div>
                <div class="back">
                    <div id="b1" class="back-content">
                        <!-- Dos vide -->
                    </div>
                </div>
            </div>

            <!-- Page 2 - Deuxième image -->
            <div id="p2" class="paper">
                <div class="front">
                    <div id="f2" class="front-content">
                        <img class="img-fluid" style="object-fit: cover;width:100%;" src="{{ asset('image/granny.png') }}" alt="Deuxième image">
                    </div>
                </div>
                <div class="back">
                    <div id="b2" class="back-content">
                        <!-- Dos vide -->
                    </div>
                </div>
            </div>

            <!-- Page 3 - Préface -->
            <div id="p3" class="paper">
                <div class="front">
                    <div id="f3" class="front-content">
                        <img class="img-fluid" style="object-fit: cover;width:100%;" src="{{ asset('image/preface.png') }}" alt="préface">
                    </div>
                </div>
                <div class="back">
                    <div id="b3" class="back-content">
                        <!-- Dos vide -->
                    </div>
                </div>
            </div>

            <!-- Les pages d'anecdotes seront générées dynamiquement ici -->
        </div>

        <div class="button-container justify-content-between">
            <button id="prev-btn" class="btn btn-link">
                <i class="fas fa-arrow-circle-left"></i>
            </button>
            <button id="next-btn" class="btn btn-link">
                <i class="fas fa-arrow-circle-right"></i>
            </button>
           
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/b4c13d4bcf.js" crossorigin="anonymous"></script>
    <script>
        var anecdotes = @json($anecdotes);
    </script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
