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
                        <img class="img-fluid" src="{{ asset('image/homebook.png') }}" alt="Couverture">
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
                        <img class="img-fluid" src="{{ asset('image/granny.png') }}" alt="Deuxième image">
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
                        <div class="container-fluid p-3">
                            <h2 class="h4 mb-3">Préface</h2>
                            <p class="small">LE LIVRE DU SOUVENIR


                                EN MÉMOIRE DE GRANNY
                                Madame Hermine OLORY-TOGBE, née Da Silva

                                Préface

                                Vous avez connu Granny.
                                Vous avez probablement vécu des moments privilégiés avec elle.

                                À l'occasion du 90ème anniversaire de sa naissance, nous lançons cette initiative pour
                                aller à la recherche des facettes de sa vie que nous ne connaissions pas forcément.

                                Ainsi nous invitons tous ceux qui souhaitent contribuer à ce LIVRE DU SOUVENIR, de
                                remplir en ligne la Fiche Web ci-après.

                                Le But n'est pas, absolument pas, de la glorifier; mais plutôt de rechercher dans les
                                souvenirs en hibernation dans vos mémoires, un événement que vous avez vécu avec elle et
                                qui vous a permis de découvrir quelque chose de son être. Ce quelque chose, vous pourrez
                                le décrire dans cette Fiche Web, sous forme du récit d'une anecdote vécue avec elle, ou
                                sous une forme substantielle de la vision que vous aviez de sa vie ou de son être.

                                Écrire ce Livre ensemble, deviendra donc, une manière de graver des souvenirs
                                ineffaçables de son parcours de vie; les souvenirs décrits par les uns, devenant une
                                sorte de NOUVELLE RENCONTRE D'ELLE pour les autres lecteurs.

                                Nous espérons ainsi, pouvoir recueillir 90 TÉMOIGNAGES inédits, POUR commémorer les 90
                                ANS de sa naissance.

                                Mis bout à bout, ces témoignages formeront un Livre de NOTRE MÉMOIRE COLLECTIVE DE
                                GRANNY.

                                Le Souvenir reste essentiel, niant imperceptiblement l'écoulement du temps...

                                De Johannesburg, Rome, Sao Paulo, Cherbourg, et Cotonou
                                Nous ses enfants Eric, Evelyne, Olga et Hortense-Aicha,
                                Vous disons donc par avance MERCI.
                                Merci à tous ceux qui contribueront à la construction de ce Livre.

                            </p>
                        </div>
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
    <script src="https://kit.fontawesome.com/b4c13d4bcf.js" crossorigin="anonymous"></script>
    <script>
        var anecdotes = @json($anecdotes);
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
