document.addEventListener('DOMContentLoaded', () => {
    // DOM elements
    const startScreen = document.getElementById('start-screen');
    const startGameBtn = document.getElementById('start-button');
    const passengerContainer = document.getElementById('passengers');
    const bus = document.getElementById('bus');
    const gameOverModal = document.getElementById('game-over-modal');
    const nextLevelModal = document.getElementById('next-level-modal');
    const restartButton = document.getElementById('restart-button');
    const continueButton = document.getElementById('continue-button');

    // Game variables
    let passengerOrder = [];
    let clickedOrder = [];
    let level = 1; // Start at level 1
    const basePassengerSize = 3; // Initial size

    // Event listeners
    startGameBtn.addEventListener('click', main);
    restartButton.addEventListener('click', () => {
        gameOverModal.style.display = 'none';
        startLevel();
    });
    continueButton.addEventListener('click', () => {
        nextLevelModal.style.display = 'none';
        startLevel();
    });

    // Main function to start the game
    function main() {
        startScreen.style.display = 'none';
        startLevel();
    }

    // Function to start a level
    function startLevel() {
        bgm.play();
        const passengerSize = basePassengerSize + level - 1; // Increase passenger size with level
        document.getElementById('level-indicator').textContent = "Level " + level;
        busEntry();
        resetPassengers();
        createPassengerOrder(passengerSize);
        generatePassengers(passengerSize);
        passengerEntry();
    }

    // Function to create the order of passengers
    function createPassengerOrder(size) {
        clickedOrder.length = 0;
        passengerOrder = Array.from({ length: size }, (_, i) => "pas" + (i + 1));
        shuffle(passengerOrder);
    }

    // Function to clear existing passengers
    function resetPassengers() {
        passengerContainer.innerHTML = ''; // Clear all existing passenger elements
    }

    // Function to generate passengers
    function generatePassengers(size) {
        for (let i = 0; i < size; i++) {
            const newPassenger = document.createElement('div');
            newPassenger.classList.add('passenger');
            newPassenger.id = "pas" + (i + 1);
            newPassenger.addEventListener('animationend', () => {
                newPassenger.addEventListener("click", () => clickPassenger(newPassenger.id));
            });
        
            const passengerText = document.createElement('div');
            passengerText.textContent = "pas" + (i + 1);
            passengerText.classList.add('passenger-text');

            const passengerImage = document.createElement('img');
            passengerImage.src = "source/pass1.gif"; // Set the path to your passenger image
            passengerImage.alt = "Passenger"; // Add an alt attribute for accessibility
            passengerImage.classList.add('passenger-image');

            newPassenger.appendChild(passengerText);
            newPassenger.appendChild(passengerImage);
            passengerContainer.appendChild(newPassenger);
        }
    }

    // Function to animate passenger entry
    function passengerEntry() {
        passengerOrder.forEach((passenger, index) => {
            setTimeout(() => {
                const n = document.getElementById(passenger);
                n.style.animation = 'passengerEntry 3s ease-out forwards';
                n.addEventListener('animationend', () => {
                    const passengerImage = n.querySelector('.passenger-image');
                    passengerImage.src = "source/pass1.png"; // Set the path to the new passenger image
                });
            }, (index + 1) * 900);
        });
    }

    // Function to handle clicking on a passenger
    function clickPassenger(id) {
        const passenger = document.getElementById(id);
        clickedOrder.push(id);

        const passengerImages = passenger.querySelectorAll('.passenger-image');
        passengerImages.forEach(image => {
            passenger.classList.add('passenger-unclickable'); // enusre passenger can oly be clicked once
            image.src = "source/pass1.gif";
        });

        passenger.style.animation = 'passengerExit 0.5s ease-out forwards';
        passenger.addEventListener('animationend', () => {
            passenger.classList.add('passenger-hidden');
        });

        if (clickedOrder.length === passengerOrder.length) {
            checkAns(clickedOrder, passengerOrder);
        }
    }

    // Function to check the answer
    function checkAns(playerAns, realAns) {
        if (arraysEqual(playerAns, realAns)) {
            playNextLevelSound();
            nextLevelModal.style.display = 'block';
            level++;
            busExit();
        } else {
            playGameOverSound();
            gameOverModal.style.display = 'block';
            busExit();
            resetGame();
        }
    }

    // Function to reset the game
    function resetGame() {
        level = 1;
    }

    // Function to check if arrays are equal
    function arraysEqual(arr1, arr2) {
        return arr1.length === arr2.length && arr1.every((val, index) => val === arr2[index]);
    }

    // Function to shuffle an array
    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    // Function to animate bus entry
    function busEntry() {
        bus.style.animation = 'busEntry 3s ease-out forwards'; 
        bus.addEventListener('animationend', () => {
            const busImg = bus.querySelector('.busImg');
            busImg.src = "source/bus_static.png";
        });
    }

    // Function to animate bus exit
    function busExit() {
        const busImg = bus.querySelector('.busImg');
        busImg.src = "source/bus_moving.gif";
        bus.style.animation = 'busExit 2s ease-in forwards';
    }

    // Delegate click event to passenger container to handle dynamic elements
    passengerContainer.addEventListener('click', (event) => {
        const passenger = event.target.closest('.passenger');
        if (passenger && passenger.classList.contains('passenger-clickable')) {
            clickPassenger(passenger.id);
        }
    });

    // PAUSE MODAL & BGM START
    const bgm = document.getElementById("bgm");
    const nextLevelSound = document.getElementById('next-level-sound');
    const gameOverSound = document.getElementById('game-over-sound');
    const muteBtn = document.getElementById("mute-btn");
    const pauseModal = document.getElementById('pauseModal')
    const pauseBtn = document.getElementById("pause-button");
    const resumeBtn = document.getElementById('resume-btn')
    const quitBtn = document.querySelectorAll('.quit-btn');

    pauseBtn.addEventListener("click", showPauseModal);
    resumeBtn.addEventListener("click", resumeGame);
    quitBtn.forEach(btn=>{
        btn.addEventListener("click", quitGame);
    })
    muteBtn.addEventListener("click", function() {
        if (bgm.muted) {
            bgm.muted = false;
            muteBtn.textContent = "Mute";
        } else {
            bgm.muted = true;
            muteBtn.textContent = "Unmute";
        }
    });

    // MAIN BGM
    function playBGM(){
        bgm.play();
    }

    //play game over sound
    function playNextLevelSound() {
        nextLevelSound.play();
    }
    
    //play game over sound
    function playGameOverSound() {
        gameOverSound.play();
    }
    
    function showPauseModal() {
        pauseModal.style.display = "flex";
    }
    
    function resumeGame() {
        pauseModal.style.display = "none";
    }
    
    function quitGame() {
        window.location.href = "gamemenu.php";
    }

    // PASUE MODAL END
});
