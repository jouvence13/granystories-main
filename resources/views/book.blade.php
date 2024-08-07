<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'anecdotes</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <button id="prev-btn">
        <i class="fas fa-arrow-circle-left"></i>
    </button>

    <div id="book" class="book">
        <!-- Page 1 - Image de couverture -->
        <div id="p1" class="paper">
            <div class="front">
                <div id="f1" class="front-content">
                    <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('image/homebook.png') }}" alt="Couverture">
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
                    <img src="{{ asset('image/page2.jpg') }}" alt="Deuxième image">
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
                    <h2>Préface</h2>
                    <p>Texte introductif ici...</p>
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

    <button id="next-btn">
        <i class="fas fa-arrow-circle-right"></i>
    </button>

    <script src="https://kit.fontawesome.com/b4c13d4bcf.js" crossorigin="anonymous"></script>
    <script>
        var anecdotes = @json($anecdotes);
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
