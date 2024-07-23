document.addEventListener('DOMContentLoaded', () => {
    // func1();

    const startScreen = document.getElementById('start-screen');
    const startGameBtn = document.getElementById('start-button');
    const passengerContainer = document.getElementById('passengers');
    const bus = document.getElementById('bus');
    const gameOverModal = document.getElementById('game-over-modal');
    const nextLevelModal = document.getElementById('next-level-modal');
    const restartButton = document.getElementById('restart-button');
    const continueButton = document.getElementById('continue-button');

    let passengerOrder = [];
    let clickedOrder = [];
    let level = 1; // Start at level 1
    const basePassengerSize = 3; // Initial size
    const priorities = [1, 2, 3, 4, 5]; // Fixed set of priorities


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

    startGameBtn.addEventListener('click', main);

    function main() {
        startScreen.style.display = 'none';
        startLevel();
    }

    function startLevel() {
        playBGM();
        const passengerSize = basePassengerSize + level - 1; // Increase passenger size with level
        document.getElementById('level-indicator').textContent = "Level " + level;
        busEntry();
        resetPassengers();
        createPassengerOrder(passengerSize);
        generatePassengers(passengerSize);
        passengerEntry();
    }

    function createPassengerOrder(size) {
        clickedOrder.length = 0;
        passengerOrder = generateRandomPriorities(size);
    }

    function generateRandomPriorities(size) {
        const order = [];
        for (let i = 0; i < size; i++) {
            const randomPriority = priorities[Math.floor(Math.random() * priorities.length)];
            order.push(randomPriority);
        }
        return order;
    }

    function resetPassengers() {
        passengerContainer.innerHTML = ''; // Clear all existing passenger elements
    }

    function generatePassengers(size) {
        for (let i = 0; i < size; i++) {
            const priority = passengerOrder[i];
            const newPassenger = document.createElement('div');
            newPassenger.classList.add('passenger');
            newPassenger.id = "pas" + priority + "_" + i; // Ensure unique IDs
            newPassenger.dataset.priority = priority;
            newPassenger.addEventListener('animationend', () => { // ensure the passengers have all stopped before players may click
                newPassenger.classList.add('passenger-clickable');
            });

            const passengerText = document.createElement('div');
            passengerText.textContent = "Pass" + (i+1);
            passengerText.classList.add('passenger-text');

            const passengerImage = document.createElement('img');
            passengerImage.src = "source/priority/pri" + priority + ".gif"; // Set the path to your passenger image
            passengerImage.alt = "Passenger"; // Add an alt attribute for accessibility
            passengerImage.classList.add('passenger-image');

            newPassenger.appendChild(passengerText);
            newPassenger.appendChild(passengerImage);
            passengerContainer.appendChild(newPassenger);
        }
    }

    function passengerEntry() {
        passengerOrder.forEach((priority, index) => {
            const n = document.getElementById("pas" + priority + "_" + index);
            n.style.animation = 'passengerEntry 3s ease-out forwards';
            n.addEventListener('animationend', () => {
                // Animation has ended, change the image here
                const passengerImage = n.querySelector('.passenger-image');
                passengerImage.src = "source/priority/pri" + priority + ".png"; // Set the path to the new passenger image
            });
        });
    }

    function clickPassenger(id) {
        const passenger = document.getElementById(id);
        const priority = parseInt(passenger.dataset.priority, 10);
        clickedOrder.push(priority);
        passenger.classList.remove('passenger-clickable');
        const passengerImages = passenger.querySelectorAll('.passenger-image');
        passengerImages.forEach(image => {
            image.src = "source/priority/pri" + priority + ".gif"; // Path to your static PNG
        });
        passenger.style.animation = 'passenger-exit 0.5s ease-out forwards';
        passenger.addEventListener('animationend', () => {
            passenger.classList.add('passenger-hidden');
        });

        if (clickedOrder.length === passengerOrder.length) {
            checkAns(clickedOrder);}
    }

    function checkAns(playerAns) {
        if (isInOrder(playerAns)) {
            playNextLevelSound();
            level++;
            busExit();
            setTimeout(() => {
                nextLevelModal.style.display = 'block';
            }, 3000);
        } else {
            playGameOverSound();
            busExit();
            gameOverModal.style.display = 'block';
            resetGame();
        }
    }

    function resetGame() {
        level = 1;
    }

    function isInOrder(list) {
        for (let i = 0; i < list.length - 1; i++) {
            if (list[i] > list[i + 1]) {
                return false;
            }
        }
        return true;
    }

    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function busEntry() {
        bus.style.animation = 'busEntry 3s ease-out forwards';
        bus.addEventListener('animationend', () => {
            const busImg = bus.querySelector('.busImg');
            busImg.src = "source/bus_static.png";
        });
    }

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
            console.log("AC:"+clickedOrder)
            console.log("AC"+passengerOrder)
        }
    });

    restartButton.addEventListener('click', () => {
        gameOverModal.style.display = 'none';
        startLevel();
    });

    continueButton.addEventListener('click', () => {
        nextLevelModal.style.display = 'none';
        startLevel();
    });

});