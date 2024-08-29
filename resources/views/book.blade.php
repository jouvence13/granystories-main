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

        .image-container {
            width: 80%;
            /* Prendre 80% de la largeur du conteneur */
            height: auto;
            /* Ajuster la hauteur automatiquement */
            margin: 0 auto;
            /* Centrer horizontalement */
            display: flex;
            /* Utiliser flexbox pour centrer verticalement */
            align-items: center;
            /* Centrer verticalement */
            justify-content: center;
            /* Centrer horizontalement */
            text-align: center;
            /* Assurer que l'image est centrée dans le conteneur */
        }

        .img-fluid {
            max-width: 100%;
            /* Assurer que l'image ne dépasse pas le conteneur */
            height: auto;
            /* Conserver les proportions de l'image */
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

            <!-- Table des matières dynamique -->
            @php
                $itemsPerPage = 45;
                $totalPages = ceil(count($anecdotes) / $itemsPerPage);
            @endphp

            @for ($pageNum = 0; $pageNum < $totalPages; $pageNum++)
                <div id="p{{ 4 + $pageNum }}" class="paper">
                    <div class="front">

                        <div id="f{{ 4 + $pageNum }}" class="story-content">
                            <div class="story-header text-center">
                                <h6 class="story-name">MERCI À TOUS CEUX QUI ONT DÉJÀ INSÉRÉ LEURS TÉMOIGNAGES</h6>
                            </div>
                            <div style="font-size: 8.5px;">
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            @foreach ($anecdotes->slice($pageNum * $itemsPerPage, $itemsPerPage / 2) as $index => $anecdote)
                                                <li style="margin-bottom: 2px;"
                                                    data-name="{{ $anecdote->prenom }} {{ $anecdote->nom }}">
                                                    {{ $anecdote->prenom }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled">
                                            @foreach ($anecdotes->slice($pageNum * $itemsPerPage + $itemsPerPage / 2, $itemsPerPage / 2) as $index => $anecdote)
                                                <li style="margin-bottom: 2px;"
                                                    data-name="{{ $anecdote->prenom }} {{ $anecdote->nom }}">
                                                    {{ $anecdote->prenom }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="story-footer">
                                <span class="story-location">{{ $anecdotes->count() }} témoignants</span>
                                <span class="story-date">{{ $pageNum + 1 }}/{{ $totalPages }}</span>
                            </div>
                        </div>

                    </div>
                    <div class="back">
                        <div id="b{{ 4 + $pageNum }}" class="back-content">
                            <!-- Contenu du dos de la page (vide ou avec un contenu spécifique si nécessaire) -->
                        </div>
                    </div>
                </div>
            @endfor
            <!-- enecdote -->
            @php
                $pageHeight = 460; // Hauteur approximative de la zone de contenu en pixels (500px - 40px de padding)
                $fontSize = 7; // Taille de police minimale
                $lineHeight = $fontSize * 1.5; // Hauteur de ligne approximative
                $charsPerLine = floor(310 / ($fontSize * 0.6)); // Nombre approximatif de caractères par ligne (350px de largeur - 40px de padding)
                $linesPerPage = floor($pageHeight / $lineHeight);
                $charsPerPage = $charsPerLine * $linesPerPage;

                $totalPages = $totalPages + 4; // Ajustement pour les pages précédentes
            @endphp

            @foreach ($anecdotes as $index => $anecdote)
                @php
                    $anecdoteHtml = $anecdote->anecdote;
                    $pageContent = '';
                    $currentPage = 0;
                    $isFirstPage = true;
                    $hasImage = !empty($anecdote->image);
                @endphp

                @while ($anecdoteHtml !== '')
                    @php
                        // Couper le texte jusqu'à la limite du conteneur
$contentChunk = substr($anecdoteHtml, 0, $charsPerPage);

// Trouver la dernière position d'un point, virgule, point d'exclamation ou d'interrogation avant la limite
                        $lastPunctuationPos = max(
                            strrpos($contentChunk, '.'),
                            strrpos($contentChunk, ','),
                            strrpos($contentChunk, '!'),
                            strrpos($contentChunk, '?'),
                        );

                        // Si une ponctuation est trouvée et est proche de la limite, couper ici
                        if ($lastPunctuationPos !== false && $lastPunctuationPos > $charsPerPage - 20) {
                            $endPos = $lastPunctuationPos + 1;
                        } else {
                            // Sinon, trouver la dernière fin de balise HTML avant la limite
                            if (preg_match('/<\/[a-z][a-z0-9]*>$/i', $contentChunk, $matches, PREG_OFFSET_CAPTURE)) {
                                $endPos = $matches[0][1] + strlen($matches[0][0]);
                            } else {
                                $endPos = strlen($contentChunk);
                            }
                        }

                        $pageContent = substr($anecdoteHtml, 0, $endPos);
                        // Supprimer le contenu coupé de l'anecdote pour la prochaine itération
                        $anecdoteHtml = substr($anecdoteHtml, $endPos);
                    @endphp

                    <div id="p{{ $totalPages }}" class="paper">
                        <div class="front">
                            <div class="story-content" data-name="{{ $anecdote->prenom }} {{ $anecdote->nom }}">
                                @if ($isFirstPage)
                                    <div class="story-header">
                                        <h5 class="story-name">{{ $anecdote->prenom }} {{ $anecdote->nom }}</h5>
                                        <p class="story-relation">{{ $anecdote->relation }}</p>
                                    </div>
                                @endif
                                <div class="story-anecdote"
                                    style="font-size: {{ $fontSize }}px; line-height: {{ $lineHeight }}px;">
                                    {!! $pageContent !!}
                                </div>
                                @if ($anecdoteHtml === '' && $hasImage)
                                    @php
                                        $totalPages++; // Page pour l'image
                                    @endphp
                                @endif
                                @if ($anecdoteHtml === '')
                                    <div class="story-footer">
                                        <span class="story-location">{{ $anecdote->ville }},
                                            {{ $anecdote->pays }}</span>
                                        <span
                                            class="story-date">{{ \Carbon\Carbon::parse($anecdote->created_at)->format('d/m/Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="back">
                            <div id="b{{ $totalPages }}" class="back-content p-3">
                                <!-- Dos vide -->
                            </div>
                        </div>
                    </div>

                    @if ($anecdoteHtml === '' && $hasImage)
                        <!-- Page d'image après l'anecdote -->
                        <div id="p{{ $totalPages }}" class="paper">
                            <div class="front">
                                <div class="story-content">
                                    <div class="story-header">
                                        <h5 class="story-name">{{ $anecdote->prenom }} {{ $anecdote->nom }}</h5>
                                        <p class="story-relation">{{ $anecdote->relation }}</p>
                                    </div>
                                    <div class="image-container">
                                        <img class="img-fluid" style="object-fit: cover;"
                                            src="{{ asset('image/' . $anecdote->image) }}"
                                            alt="Image pour l'anecdote">
                                    </div>
                                    <div class="story-footer">
                                        <span class="story-location">{{ $anecdote->ville }},
                                            {{ $anecdote->pays }}</span>
                                        <span
                                            class="story-date">{{ \Carbon\Carbon::parse($anecdote->created_at)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="back">
                                <div class="back-content">
                                    <!-- Dos vierge -->
                                </div>
                            </div>
                        </div>

                        @php
                            $totalPages++;
                            $hasImage = false; // Assurer que l'image est seulement ajoutée une fois
                        @endphp
                    @endif

                    @php
                        $isFirstPage = false;
                    @endphp
                @endwhile
            @endforeach

            <!-- Dernière page -->
            <div id="p{{ $totalPages }}" class="paper">
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
            const maxFontSize = 9; // Taille maximale de la police en pixels
            const minFontSize = 5; // Taille minimale de la police en pixels
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

        createAnecdoteLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = "/anecdote/create";
        });

        book.parentNode.appendChild(createAnecdoteLink);

        function adjustButtonMargin() {
            createAnecdoteLink.style.marginTop = window.innerWidth <= 768 ? "5px" : "20px";
        }

        window.addEventListener('load', adjustButtonMargin);
        window.addEventListener('resize', adjustButtonMargin);

        console.log('Lien de création d\'anecdote créé');

        let currentLocation = 1;
        const papers = document.querySelectorAll('.paper');
        let numOfPapers = papers.length;
        let maxLocation = numOfPapers + 1;

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
            document.querySelectorAll('.anecdote-page').forEach(page => {
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
                book.style.transform = isAtBeginning ? "translateX(0%)" : "translateX(100%)";
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
                const paper = papers[currentLocation - 1];
                if (paper) {
                    paper.classList.add("flipped");
                    paper.style.zIndex = currentLocation;
                }
                if (currentLocation === 1) {
                    openBook();
                } else if (currentLocation === maxLocation - 1) {
                    closeBook(false);
                }
                currentLocation++;
                updateButtons();
            }
        }

        function goPrevPage() {
            if (currentLocation > 1) {
                const paper = papers[currentLocation - 2];
                if (paper) {
                    paper.classList.remove("flipped");
                    paper.style.zIndex = numOfPapers - currentLocation + 2;
                }
                if (currentLocation === 2) {
                    closeBook(true);
                } else if (currentLocation === maxLocation) {
                    openBook();
                }
                currentLocation--;
                updateButtons();
            }
        }

        function updateButtons() {
            const tableOfContentsPages = document.querySelectorAll('.paper .card').length;
            const firstAnecdotePage = 5 + tableOfContentsPages;

            prevBtn.disabled = (currentLocation === 1);
            prevBtn.style.opacity = (currentLocation === 1) ? 0.5 : 1;
            nextBtn.disabled = (currentLocation === maxLocation);
            nextBtn.style.opacity = (currentLocation === maxLocation) ? 0.5 : 1;

            if (currentLocation === 1) {
                nextBtn.value = "Voir la page de garde";
                prevBtn.value = "";
            } else if (currentLocation === 2) {
                nextBtn.value = "Voir la préface";
                prevBtn.value = "Voir la couverture";
            } else if (currentLocation === 3) {
                nextBtn.value = "Page suivante";
                prevBtn.value = "Voir la Page de garde";
            } else if (currentLocation >= 4 && currentLocation < firstAnecdotePage) {
                nextBtn.value = "Page suivante";
                prevBtn.value = "Page précédente";
            } else if (currentLocation === firstAnecdotePage) {
                nextBtn.value = "Voir les témoignages";
                prevBtn.value = "Page précédente";
            } else if (currentLocation > firstAnecdotePage && currentLocation < maxLocation) {
                nextBtn.value = "Témoignage suivant";
                prevBtn.value = "Page précédente";
            } else if (currentLocation === maxLocation) {
                nextBtn.value = "";
                prevBtn.value = "Page précédente";
            }

            prevBtn.textContent = prevBtn.value;
            nextBtn.textContent = nextBtn.value;

            if (window.innerWidth <= 768) {
                prevBtn.style.fontSize = nextBtn.style.fontSize = "6px";
                prevBtn.style.padding = nextBtn.style.padding = "6px 10px";
            } else {
                prevBtn.style.fontSize = nextBtn.style.fontSize = "12px";
                prevBtn.style.padding = nextBtn.style.padding = "8px 16px";
            }
        }

        function initBook() {
            console.log('initBook() appelée');
            closeBook(true);
            papers.forEach((paper, index) => {
                paper.classList.remove("flipped");
                paper.style.zIndex = numOfPapers - index;
            });
            currentLocation = 1;
            updateButtons();
            initializePages();
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
    <script>
        // Fonction pour simuler la navigation vers la page suivante
        function simulateGoNextPage(times) {
            if (times > 0) {
                goNextPage();
                setTimeout(function() {
                    simulateGoNextPage(times - 1);
                }, 50);
            }
        }

        // Fonction pour naviguer vers une page spécifique en fonction du nom cliqué
        function navigateToName(targetName) {
            let targetPage = null;

            // Parcourir tous les éléments avec la classe .paper pour trouver la page cible
            document.querySelectorAll('.paper').forEach((paper, index) => {
                const nameElement = paper.querySelector(`[data-name="${targetName}"]`);
                if (nameElement) {
                    targetPage = index + 1; // Index des pages commence à 1
                }
            });

            if (targetPage !== null) {
                const pagesToTurn = targetPage - currentLocation;
                simulateGoNextPage(pagesToTurn);
            } else {
                console.error(`Nom "${targetName}" non trouvé.`);
            }
        }

        // Ajouter des écouteurs d'événements aux éléments de la table des matières
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.story-content li').forEach(li => {
                li.style.cursor = 'pointer';
                li.addEventListener('click', function() {
                    const targetName = this.getAttribute('data-name');
                    if (targetName) {
                        navigateToName(targetName);
                    }
                });
            });
        });
    </script>

</body>

</html>
