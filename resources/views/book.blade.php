<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRANNY'STORIES</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v=1.0.1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML to PDF Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js"
        integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .story-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .story-header {
            background-color: rgba(184, 130, 60, 0.8);
            padding: 5px;
            /* Réduit le padding */
            border-radius: 5px;
            margin-bottom: 8px;
            /* Réduit la marge */
        }

        .story-name {
            margin: 0;
            font-weight: bold;
            font-size: 0.6em;
            /* Réduit la taille du texte */
            overflow: hidden;
            text-overflow: ellipsis;

        }

        .story-relation {
            margin: 0;
            text-align: right;
            font-size: 0.4em;
            /* Réduit la taille du texte */
            font-style: italic;
            overflow: hidden;
            text-overflow: ellipsis;

        }

        .story-anecdote {
            font-size: 10px;
            /* Taille initiale, ajustée par le script */
            overflow: hidden;

            height: auto;
            /* La hauteur sera ajustée par la taille de la police */
            width: 100%;
            font-family: Verdana, Tahoma, sans-serif;
        }


        .story-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.3em;
            /* Réduit la taille du texte */
            padding: 2px;
            /* Réduit le padding */
            background-color: rgba(184, 130, 60, 0.8);
            border-radius: 4px;
        }

        .story-location {
            flex: 1;
            font-style: italic;
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;

        }

        .story-date {
            text-align: right;
            overflow: hidden;
            text-overflow: ellipsis;

        }
    </style>


</head>


<body style="background-color:  rgb(177, 111, 25);">
    <div id="video-container"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
        background-color: #9c6113; /* Fond blanc */
        display: flex; justify-content: center; align-items: center; 
        z-index: 9999; overflow: hidden; transition: opacity 0.5s ease;">
        <video autoplay muted loop
            style="position: absolute; top: 50%; left: 50%; width: 100%; height: 100%; 
              object-fit: contain; transform: translate(-50%, -50%);">
            <source src="{{ asset('videos/Grannys.mp4') }}" type="video/mp4">
            Votre navigateur ne supporte pas la balise vidéo.
        </video>
    </div>

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
                        <img class="img-fluid" style="object-fit: cover;width:100%;"
                            src="{{ asset('image/granny.png') }}" alt="Deuxième image">
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
                        <img class="img-fluid" style="object-fit: cover;width:100%;"
                            src="{{ asset('image/preface.png') }}" alt="Préface">
                    </div>
                </div>
                <div class="back">
                    <div id="b3" class="back-content">
                        <!-- Dos vide -->
                    </div>
                </div>
            </div>

            <!-- Page 4 - Merci -->
            <div id="p4" class="paper">
                <div class="front">
                    <div id="f4" class="front-content">
                        <img class="img-fluid" style="object-fit: cover;width:100%;"
                            src="{{ asset('image/merci_granny.png') }}" alt="Merci">
                    </div>
                </div>
                <div class="back">
                    <div id="b4" class="back-content">
                        <!-- Dos vide -->
                    </div>
                </div>
            </div>

            <div id="p5" class="paper">
                <div class="card">
                    <div class="card-header text-center bg-light border-bottom">
                        <h6>Liste des témoignants (1/2)</h6>
                    </div>
                    <div class="card-body p-3" style="font-size: 8.5px; border: 3px solid rgb(228, 169, 93);; border-radius: 3px;">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    @foreach ($anecdotes->slice(0, 22) as $index => $anecdote)
                                        <li style="margin-bottom: 2px;">
                                            {{ $index + 1 }}. {{ $anecdote->prenom }} - Page {{ $index + 5 }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    @foreach ($anecdotes->slice(22, 23) as $index => $anecdote)
                                        <li style="margin-bottom: 2px;">
                                            {{ $index + 23 }}. {{ $anecdote->prenom }} - Page {{ $index + 27 }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="p6" class="paper">
                <div class="card">
                    <div class="card-header text-center bg-light border-bottom">
                        <h6>Liste des témoignants (2/2)</h6>
                    </div>
                    <div class="card-body p-3" style="font-size: 8.5px; border: 3px solid rgb(228, 169, 93);; border-radius: 3px;">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    @foreach ($anecdotes->slice(45, 22) as $index => $anecdote)
                                        <li style="margin-bottom: 2px;">
                                            {{ $index + 46 }}. {{ $anecdote->prenom }} - Page {{ $index + 50 }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    @foreach ($anecdotes->slice(67, 23) as $index => $anecdote)
                                        <li style="margin-bottom: 2px;">
                                            {{ $index + 68 }}. {{ $anecdote->prenom }} - Page {{ $index + 72 }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Boucle pour générer dynamiquement les pages d'anecdotes -->
            @foreach ($anecdotes as $index => $anecdote)
                <div id="p{{ $index + 7 }}" class="paper">
                    <div class="front">
                        <div class="story-content">
                            <div class="story-header">
                                <h5 class="story-name">{{ $anecdote->prenom }} {{ $anecdote->nom }}</h5>
                                <p class="story-relation">{{ $anecdote->relation }}</p>
                            </div>
                            <div class="story-anecdote">
                                {!! $anecdote->anecdote !!}
                            </div>
                            <div class="story-footer">
                                <span class="story-location">{{ $anecdote->ville }}, {{ $anecdote->pays }}</span>
                                <span
                                    class="story-date">{{ \Carbon\Carbon::parse($anecdote->created_at)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="back">
                        <div id="b{{ $index + 7 }}" class="back-content p-3">
                            <!-- Dos vide -->
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Dernière page -->
            <div id="p{{ $anecdotes->count() + 7 }}" class="paper">
                <div class="front">
                    <div class="front-content">
                        <img class="img-fluid" style="object-fit: cover; width: 100%;"
                            src="{{ asset('image/lastback.png') }}" alt="Dernière page">
                    </div>
                </div>
                <div class="back">
                    <div class="back-content">
                        <!-- Dos vierge -->
                    </div>
                </div>
            </div>
        </div>


        <div class="button-container justify-content-between">
            <button id="prev-btn" class="btn btn-warning" value=""></button>
            <button id="next-btn" class="btn btn-warning" value=""></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://kit.fontawesome.com/b4c13d4bcf.js" crossorigin="anonymous"></script>
    <script>
        var anecdotes = @json($anecdotes);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const videoContainer = document.getElementById("video-container");

            window.addEventListener('load', function() {
                // Appliquer l'effet de transition pour masquer la vidéo
                videoContainer.style.opacity = "0";

                // Masquer le conteneur après la transition pour éviter les clics
                setTimeout(() => {
                    videoContainer.style.display = "none";
                }, 500); // Durée de la transition pour masquer le conteneur
            });
        });
    </script>
    <script>
        function adjustFontSize(element) {
            const maxFontSize = 12; // Taille maximale de la police en pixels
            const minFontSize = 3.9; // Taille minimale de la police en pixels
            let fontSize = maxFontSize;

            element.style.fontSize = fontSize + 'px';

            // Réduit la taille de la police en fonction du texte
            while (element.scrollHeight > element.clientHeight && fontSize > minFontSize) {
                fontSize -= 1;
                element.style.fontSize = fontSize + 'px';
            }
        }

        document.querySelectorAll('.story-anecdote').forEach(adjustFontSize);
    </script>
    <script>
        const prevBtn = document.querySelector("#prev-btn");
        const nextBtn = document.querySelector("#next-btn");
        const book = document.querySelector("#book");

        const createAnecdoteLink = document.createElement("a");
        createAnecdoteLink.classList.add("btn", "btn-primary", "mt-3");
        createAnecdoteLink.textContent = "Ajouter mon témoignage";
        createAnecdoteLink.style.zIndex = 10;
        createAnecdoteLink.style.fontSize = "12px";

        // Utilisation d'un gestionnaire d'événements pour rediriger au clic
        createAnecdoteLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche l'action par défaut du lien
            window.location.href = "/anecdote/create"; // Redirection manuelle
        });

        book.parentNode.appendChild(createAnecdoteLink);

        function adjustButtonMargin() {
            if (window.innerWidth <= 768) {
                createAnecdoteLink.style.marginTop = "5px"; // Réduire la marge sur mobile
            } else {
                createAnecdoteLink.style.marginTop = "20px"; // Marge normale sur les grands écrans
            }
        }

        // Appeler la fonction au chargement de la page et lors du redimensionnement
        window.addEventListener('load', adjustButtonMargin);
        window.addEventListener('resize', adjustButtonMargin);

        console.log('Lien de création d\'anecdote créé');

        let currentLocation = 1;
        let numOfPapers = document.querySelectorAll('.paper')
            .length; // Mise à jour pour récupérer dynamiquement le nombre de pages
        let maxLocation = numOfPapers;

        function resizeText(element) {
            let fontSize = 16;
            element.style.fontSize = fontSize + 'px';

            while (element.scrollHeight > element.clientHeight && fontSize > 8) {
                fontSize--;
                element.style.fontSize = fontSize + 'px';
            }
        }

        function initializePages() {
            const prefaceElement = document.querySelector('#f2 .front-content');
            if (prefaceElement) {
                resizeText(prefaceElement);
            }

            const anecdotePages = document.querySelectorAll('.anecdote-page');
            anecdotePages.forEach(page => {
                resizeText(page.querySelector('.anecdote-text'));
            });
        }

        function openBook() {
            if (window.innerWidth > 768) {
                book.style.transform = "translateX(50%)";
                prevBtn.style.transform = "translateX(-100px)";
                nextBtn.style.transform = "translateX(100px)";
            } else {
                book.style.transform = "translateX(0%)";
                prevBtn.style.transform = "translateX(0px)";
                nextBtn.style.transform = "translateX(0px)";
            }
        }

        function closeBook(isAtBeginning) {
            if (window.innerWidth > 768) {
                if (isAtBeginning) {
                    book.style.transform = "translateX(0%)";
                } else {
                    book.style.transform = "translateX(50%)";
                }
                prevBtn.style.transform = isAtBeginning ? "translateX(0px)" : "translateX(-100px)";
                nextBtn.style.transform = isAtBeginning ? "translateX(0px)" : "translateX(100px)";
            } else {
                book.style.transform = "translateX(0%)";
                prevBtn.style.transform = "translateX(0px)";
                nextBtn.style.transform = "translateX(0px)";
            }
        }

        function goNextPage() {
            if (currentLocation < maxLocation) {
                switch (currentLocation) {
                    case 1:
                        openBook();
                        document.querySelector("#p1").classList.add("flipped");
                        document.querySelector("#p1").style.zIndex = 1;
                        break;
                    case maxLocation - 1:
                        closeBook(false);
                        document.querySelector(`#p${currentLocation}`).classList.add("flipped");
                        document.querySelector(`#p${currentLocation}`).style.zIndex = currentLocation;
                        break;
                    default:
                        document.querySelector(`#p${currentLocation}`).classList.add("flipped");
                        document.querySelector(`#p${currentLocation}`).style.zIndex = currentLocation;
                        break;
                }
                currentLocation++;
                updateButtons();
            }
        }

        function goPrevPage() {
            if (currentLocation > 1) {
                switch (currentLocation) {
                    case 2:
                        closeBook(true);
                        document.querySelector("#p1").classList.remove("flipped");
                        document.querySelector("#p1").style.zIndex = numOfPapers;
                        break;
                    case maxLocation:
                        closeBook(false);
                        document.querySelector(`#p${currentLocation - 1}`).classList.remove("flipped");
                        document.querySelector(`#p${currentLocation - 1}`).style.zIndex = numOfPapers - currentLocation + 2;
                        break;
                    default:
                        document.querySelector(`#p${currentLocation - 1}`).classList.remove("flipped");
                        document.querySelector(`#p${currentLocation - 1}`).style.zIndex = numOfPapers - currentLocation + 2;
                        break;
                }
                currentLocation--;
                updateButtons();
            }
        }


        function updateButtons() {
            prevBtn.disabled = (currentLocation === 1);
            prevBtn.style.opacity = (currentLocation === 1) ? 0.5 : 1;
            nextBtn.disabled = (currentLocation === maxLocation);
            nextBtn.style.opacity = (currentLocation === maxLocation) ? 0.5 : 1;
        }

        function initBook() {
            console.log('initBook() appelée');
            closeBook(true);
            for (let i = 1; i <= numOfPapers; i++) {
                document.querySelector(`#p${i}`).classList.remove("flipped");
                document.querySelector(`#p${i}`).style.zIndex = numOfPapers - i + 1;
            }
            currentLocation = 1;
            updateButtons();
            initializePages();
        }

        function updateButtons() {
            prevBtn.disabled = (currentLocation === 1);
            prevBtn.style.opacity = (currentLocation === 1) ? 0.5 : 1;
            nextBtn.disabled = (currentLocation === maxLocation);
            nextBtn.style.opacity = (currentLocation === maxLocation) ? 0.5 : 1;

            // Mise à jour des valeurs des attributs
            if (currentLocation === 1) {
                nextBtn.value = "Voir la page de garde";
                prevBtn.value = ""; // Pas de texte pour prev
            } else if (currentLocation === 2) {
                nextBtn.value = "Voir la préface";
                prevBtn.value = "Voir la couverture";
            } else if (currentLocation === 3) {
                nextBtn.value = "Page suivante";
                prevBtn.value = "Voir la préface";
            } else if (currentLocation === 4) {
                nextBtn.value = "Table des index";
                prevBtn.value = "Page Précedente";
            } else if (currentLocation === 5) {
                nextBtn.value = "Index Suivant";
                prevBtn.value = "Page Précedente";
            } else if (currentLocation === 6) {
                nextBtn.value = "Voir les témoignages";
                prevBtn.value = "Index Précedent";
            } else if (currentLocation > 6 && currentLocation < maxLocation) {
                nextBtn.value = "Témoignage suivant";
                prevBtn.value = "Page Précedente";
            } else if (currentLocation === maxLocation) {
                nextBtn.value = ""; // Pas de texte pour next
                prevBtn.value = "Page Précedente";
            }

            // Met à jour le texte des boutons en fonction des valeurs des attributs
            prevBtn.textContent = prevBtn.value;
            nextBtn.textContent = nextBtn.value;

            // Ajuster la taille des boutons et du texte pour les mobiles
            if (window.innerWidth <= 768) { // Pour les écrans de 768px ou moins
                prevBtn.style.fontSize = "6px";
                nextBtn.style.fontSize = "6px";
                prevBtn.style.padding = "6px 10px";
                nextBtn.style.padding = "6px 10px";
            } else {
                prevBtn.style.fontSize = "12px";
                nextBtn.style.fontSize = "12px";
                prevBtn.style.padding = "8px 16px";
                nextBtn.style.padding = "8px 16px";
            }
        }




        function handleResize() {
            if (window.innerWidth <= 768) {
                closeBook(true);
            } else {
                if (currentLocation === 1) {
                    closeBook(true);
                } else if (currentLocation === maxLocation) {
                    closeBook(false);
                } else {
                    openBook();
                }
            }
            initializePages();
        }

        window.addEventListener('load', initBook);
        window.addEventListener('resize', handleResize);
        prevBtn.addEventListener("click", goPrevPage);
        nextBtn.addEventListener("click", goNextPage);
    </script>
</body>

</html>
