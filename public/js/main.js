const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const book = document.querySelector("#book");

const downloadBtn = document.createElement("button");
downloadBtn.id = "download-btn";
downloadBtn.classList.add("btn", "btn-primary", "mt-3");
downloadBtn.textContent = "Télécharger le livre";
console.log('Bouton de téléchargement créé');
book.parentNode.appendChild(downloadBtn);

let currentLocation = 1;
let numOfPapers = 3;
let maxLocation = numOfPapers + 1;

function generateAnecdotePages() {
    anecdotes.forEach((anecdote, index) => {
        const paperDiv = document.createElement('div');
        paperDiv.className = 'paper';
        paperDiv.id = `p${numOfPapers + 1}`;

        paperDiv.innerHTML = `
        <div class="front">
            <div class="anecdote-card p-3">
                <div id="f${numOfPapers + 1}" class="container">
                    <div class="anecdote-header mb-3 text-center">
                        <h3 class="font-weight-bold">${anecdote.prenom} ${anecdote.nom}</h3>
                        <p class="relation text-primary">${anecdote.relation}</p>
                    </div>
                    <div class="anecdote-body">
                        ${anecdote.anecdote}
                    </div>
                    <div class="anecdote-footer d-flex justify-content-between text-muted">
                        <span class="location">${anecdote.ville}, ${anecdote.pays}</span>
                        <span class="date">${anecdote.created_at}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="back">
            <div id="b${numOfPapers + 1}" class="back-content p-3">
                <!-- Contenu du dos -->
            </div>
        </div>
        `;

        book.appendChild(paperDiv);
        numOfPapers++;
    });

    maxLocation = numOfPapers + 1;
}

console.log('Écouteur d\'événement ajouté au bouton de téléchargement');
downloadBtn.addEventListener("click", downloadPDF);
function downloadPDF() {
    const bookContainer = document.querySelector(".book-container");
    console.log('Sending HTML to server:', bookContainer.outerHTML);

    axios.post('/download-pdf', {
        html: bookContainer.outerHTML
    })
        .then(response => {
            console.log('PDF download URL:', response.data.url);
            window.location.href = response.data.url;
        })
        .catch(error => {
            console.error('Error generating PDF:', error);
        });
}

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
    console.log('initBook() appelée');
    closeBook(true);
    for (let i = 1; i <= numOfPapers; i++) {
        document.querySelector(`#p${i}`).classList.remove("flipped");
        document.querySelector(`#p${i}`).style.zIndex = numOfPapers - i + 1;
    }
    currentLocation = 1;
    updateButtons();
    generateAnecdotePages();
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