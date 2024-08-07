<!DOCTYPE html>
<html lang="en fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>

<body>
    <!-- Previous Button -->
    <button id="prev-btn">
        <i class="fas fa-arrow-circle-left"></i>
    </button>

    <!-- Book -->
    <div id="book" class="book">
        <!-- Paper 1 -->
        <div id="p1" class="paper">
            <div class="front">
                <div id="f1" class="front-content">
                    <img style="width: 350px; height: 500px;" src="{{ asset('image/page.jpg') }}" alt="Example Image">
                </div>
            </div>
            <div class="back">
                <div id="b1" class="back-content">
                    <h1>Back 1</h1>
                </div>
            </div>
        </div>

        <!-- Paper 2 -->
        <div id="p2" class="paper">
            <div class="front">
                <div id="f2" class="front-content">
                    <h1>Front 2</h1>
                </div>
            </div>
            <div class="back">
                <div id="b2" class="back-content">
                    <h1>Back 2</h1>
                </div>
            </div>
        </div>
        <!-- Paper 3 -->
        <div id="p3" class="paper">
            <div class="front">
                <div id="f3" class="front-content">
                    <h1>Front 3</h1>
                </div>
            </div>
            <div class="back">
                <div id="b3" class="back-content">
                    <h1>Back 3</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Next Button -->
    <button id="next-btn">
        <i class="fas fa-arrow-circle-right"></i>
    </button>
    <script src="https://kit.fontawesome.com/b4c13d4bcf.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
