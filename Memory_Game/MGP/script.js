// Memory Game JavaScript - Enhanced Interactivity

const gameBoard = document.getElementById("game-board");
const timerDisplay = document.getElementById("timer");
const movesDisplay = document.getElementById("moves");
const restartBtn = document.getElementById("restart");
const themeToggle = document.getElementById("theme-toggle");
const flipSound = document.getElementById("flip-sound");
const matchSound = document.getElementById("match-sound");
const bestTimeDisplay = document.getElementById("best-time");
const bestMovesDisplay = document.getElementById("best-moves");

let cards = [];
let firstCard, secondCard;
let lockBoard = false;
let moves = 0;
let timer = 0;
let interval;
let matchedPairs = 0;
const totalPairs = 8;

const emojis = ['🐶', '🐱', '🦊', '🐻', '🐼', '🐸', '🐵', '🐯'];
let gameData = [...emojis, ...emojis];

function shuffleCards() {
    gameData.sort(() => Math.random() - 0.5);
}

function createBoard() {
    gameBoard.innerHTML = "";
    shuffleCards();
    matchedPairs = 0;
    clearInterval(interval);
    
    gameData.forEach(emoji => {
        const card = document.createElement("div");
        card.classList.add("card");
        card.dataset.emoji = emoji;
        card.innerHTML = "❓";
        card.addEventListener("click", flipCard);
        gameBoard.appendChild(card);
        cards.push(card);
    });
    
    moves = 0;
    movesDisplay.textContent = moves;
    timer = 0;
    timerDisplay.textContent = timer;
    
    interval = setInterval(() => {
        timer++;
        timerDisplay.textContent = timer;
    }, 1000);
}

function flipCard() {
    if (lockBoard || this === firstCard) return;
    
    this.innerHTML = this.dataset.emoji;
    this.classList.add("flipped");
    flipSound.play();
    
    if (!firstCard) {
        firstCard = this;
        return;
    }
    secondCard = this;
    moves++;
    movesDisplay.textContent = moves;
    checkMatch();
}

function checkMatch() {
    if (firstCard.dataset.emoji === secondCard.dataset.emoji) {
        matchSound.play();
        firstCard.removeEventListener("click", flipCard);
        secondCard.removeEventListener("click", flipCard);
        matchedPairs++;
        if (matchedPairs === totalPairs) {
            clearInterval(interval);
            updateLeaderboard();
        }
        resetBoard();
    } else {
        lockBoard = true;
        setTimeout(() => {
            firstCard.innerHTML = "❓";
            secondCard.innerHTML = "❓";
            firstCard.classList.remove("flipped");
            secondCard.classList.remove("flipped");
            resetBoard();
        }, 800);
    }
}

function updateLeaderboard() {
    let bestTime = localStorage.getItem("bestTime");
    let bestMoves = localStorage.getItem("bestMoves");
    
    if (!bestTime || timer < bestTime) {
        localStorage.setItem("bestTime", timer);
        bestTimeDisplay.textContent = timer;
    } else {
        bestTimeDisplay.textContent = bestTime;
    }
    
    if (!bestMoves || moves < bestMoves) {
        localStorage.setItem("bestMoves", moves);
        bestMovesDisplay.textContent = moves;
    } else {
        bestMovesDisplay.textContent = bestMoves;
    }
}

function resetBoard() {
    [firstCard, secondCard, lockBoard] = [null, null, false];
}

restartBtn.addEventListener("click", createBoard);

// Dark Mode Toggle
let darkMode = false;
themeToggle.addEventListener("click", () => {
    darkMode = !darkMode;
    document.body.classList.toggle("dark-mode", darkMode);
    themeToggle.textContent = darkMode ? "☀️ Light Mode" : "🌙 Dark Mode";
});

// Initialize Game
createBoard();

