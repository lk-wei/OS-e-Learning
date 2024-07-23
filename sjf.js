document.addEventListener('DOMContentLoaded', () => {
    const startScreen = document.getElementById('start-screen');
    const startGameBtn = document.getElementById('start-button');
    const groupContainer = document.getElementById('groups');
    const bus = document.getElementById('bus');
    const gameOverModal = document.getElementById('game-over-modal');
    const nextLevelModal = document.getElementById('next-level-modal');
    const restartButton = document.getElementById('restart-button');
    const continueButton = document.getElementById('continue-button');

    let passengerOrder = [];
    let clickedOrder = [];
    let level = 1; // Start at level 1
    const basePassengerSize = 3; // Initial size
    const maxGroupSize = 9; // Maximum passengers per group

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
    restartButton.addEventListener('click', () => {
        gameOverModal.style.display = 'none';
        startLevel();
    });
    continueButton.addEventListener('click', () => {
        nextLevelModal.style.display = 'none';
        startLevel();
    });


    function main() {
        bgm.play();
        startScreen.style.display = 'none';
        startLevel();
    }

    function startLevel() {
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
        passengerOrder = Array.from({ length: size }, (_, i) => ({
            id: "pas" + (i + 1),
            size: Math.floor(Math.random() * 10) + 1 // Assign random size between 1 and 10
        }));
        passengerOrder.sort((a, b) => a.size - b.size); // Sort passengers by size (smallest first)
        shuffle(passengerOrder); // Shuffle the order of passengers
    }

    function resetPassengers() {
        groupContainer.innerHTML = ''; // Clear all existing passenger elements
    }

    function generatePassengers(size) {
        for (let i = 0; i < size; i++) {
            const group = document.createElement('div');
            group.classList.add('group');
            group.id = passengerOrder[i].id;

            for (let j = 0; j < passengerOrder[i].size; j++) {
                const passengerImage = document.createElement('img');
                passengerImage.src = "source/pass1.gif"; // Path to your passenger GIF
                passengerImage.alt = "Passenger";
                passengerImage.classList.add('passenger-image');
                group.appendChild(passengerImage);
            }

            group.addEventListener('animationend', () => {
                group.addEventListener("click", () => clickPassenger(group.id));
            });

            groupContainer.appendChild(group);
        }
    }

    function passengerEntry() {
        let groupIndex = 0;
        passengerOrder.forEach((group, index) => {
            setTimeout(() => {
                const n = document.getElementById(group.id);
                n.style.animation = 'groupEntry 3s ease-out forwards';
                n.addEventListener('animationend', () => {
                    const passengerImages = n.querySelectorAll('.passenger-image');
                    passengerImages.forEach(image => {
                        image.src = "source/pass1.png"; // Change to static PNG after animation ends
                    });
                });
            }, (groupIndex + 1) * 900);

            // Move to next group after maxGroupSize passengers
            if ((index + 1) % maxGroupSize === 0) {
                groupIndex++;
            }
        });
    }

    function clickPassenger(id) {
        const passenger = document.getElementById(id);
        const passengerSize = passengerOrder.find(p => p.id === id).size;
        clickedOrder.push(passengerSize);
        console.log(clickedOrder)

        const passengerImages = passenger.querySelectorAll('.passenger-image');
        passengerImages.forEach(image => {
            image.src = "source/pass1.gif";
        });
        passenger.style.animation = 'groupExit 0.5s ease-out forwards';
        passenger.addEventListener('animationend', () => {
            passenger.classList.add('group-hidden');
        });

        if (clickedOrder.length === passengerOrder.length) {
            busExit();
            checkAns(clickedOrder);
        }
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
        const busImg = bus.querySelector('.busImg');
        busImg.src = "source/bus_moving.gif";
        bus.style.animation = 'busEntry 3s ease-out forwards'; 
        bus.addEventListener('animationend', () => {
            busImg.src = "source/bus_static.png";
        });
    }

    function busExit(){
        const busImg = bus.querySelector('.busImg');
        busImg.src = "source/bus_moving.gif";
        bus.style.animation = 'busExit 2s ease-in forwards';
    }

    groupContainer.addEventListener('click', (event) => {
        const passenger = event.target.closest('.passenger');
        if (passenger && passenger.classList.contains('passenger-clickable')) {
            clickPassenger(passenger.id);
        }
    });
});
