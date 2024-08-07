const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const book = document.querySelector("#book");

let currentLocation = 1;
let numOfPapers = 3; // Commencez avec 3 pages (couverture, deuxième image, et préface)
let maxLocation = numOfPapers + 1;

function generateAnecdotePages() {
    anecdotes.forEach((anecdote, index) => {
        const paperDiv = document.createElement('div');
        paperDiv.className = 'paper';
        paperDiv.id = `p${numOfPapers + 1}`;

        paperDiv.innerHTML = `
            <div class="front">
                <div id="f${numOfPapers + 1}" class="front-content">
                    <h3>Anecdote de ${anecdote.prenom} ${anecdote.nom}</h3>
                    <p><strong>Relation:</strong> ${anecdote.relation}</p>
                    <p><strong>Lieu:</strong> ${anecdote.ville}, ${anecdote.pays}</p>
                    <p>${anecdote.anecdote}</p>
                </div>
            </div>
            <div class="back">
                <div id="b${numOfPapers + 1}" class="back-content">
                    <!-- Dos vide -->
                </div>
            </div>
        `;

        book.appendChild(paperDiv);
        numOfPapers++;
    });

    maxLocation = numOfPapers + 1;
}

generateAnecdotePages();

function openBook() {
    if (window.innerWidth > 768) {
        book.style.transform = "translateX(50%)";
        prevBtn.style.transform = "translateX(-100px)"; // Ajuster la valeur si nécessaire
        nextBtn.style.transform = "translateX(100px)";  // Ajuster la valeur si nécessaire
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
            prevBtn.style.transform = "translateX(0px)";
            nextBtn.style.transform = "translateX(0px)";
        } else {
            book.style.transform = "translateX(50%)";
            prevBtn.style.transform = "translateX(-100px)";
            nextBtn.style.transform = "translateX(100px)";
        }
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
                openBook();
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
    closeBook(true);
    for (let i = 1; i <= numOfPapers; i++) {
        document.querySelector(`#p${i}`).classList.remove("flipped");
        document.querySelector(`#p${i}`).style.zIndex = numOfPapers - i + 1;
    }
    currentLocation = 1;
    updateButtons();
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
}

window.addEventListener('load', initBook);
window.addEventListener('resize', handleResize);
prevBtn.addEventListener("click", goPrevPage);
nextBtn.addEventListener("click", goNextPage);