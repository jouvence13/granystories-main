const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const book = document.querySelector("#book");

const createAnecdoteLink = document.createElement("a");
createAnecdoteLink.classList.add("btn", "btn-primary", "mt-3");
createAnecdoteLink.textContent = "Ajouter mon témoignage";

// Utilisation d'un gestionnaire d'événements pour rediriger au clic
createAnecdoteLink.addEventListener('click', function(event) {
    event.preventDefault(); // Empêche l'action par défaut du lien
    window.location.href = "/anecdote/create"; // Redirection manuelle
});

book.parentNode.appendChild(createAnecdoteLink);

console.log('Lien de création d\'anecdote créé');

let currentLocation = 1;
let numOfPapers = document.querySelectorAll('.paper').length; // Mise à jour pour récupérer dynamiquement le nombre de pages
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
                closeBook(false); // Update to ensure centering on the last page
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
        nextBtn.value = "Voir les témoignages";
        prevBtn.value = "Voir la page de garde";
    } else if (currentLocation > 3 && currentLocation < maxLocation) {
        nextBtn.value = "Témoignage suivant";
        prevBtn.value = "Voir la préface";
    } else if (currentLocation === maxLocation) {
        nextBtn.value = ""; // Pas de texte pour next
        prevBtn.value = "Témoignage précédent";
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
