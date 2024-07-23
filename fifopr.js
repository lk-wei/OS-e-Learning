document.addEventListener('DOMContentLoaded', () => {
    const startScreen = document.getElementById('start-screen')
    const startBtn = document.getElementById('start-button');
    const frameContainer = document.getElementById('frameContainer');
    const pageContainer = document.getElementById('pageContainer');
    const queueContainer = document.getElementById('queueContainer');
    const gameOverModal = document.getElementById('game-over-modal');
    const nextLevelModal = document.getElementById('next-level-modal');
    const restartButton = document.getElementById('restart-button');
    const continueButton = document.getElementById('continue-button');

    let totalFrame = 10;
    let pageSlot = 3;
    let currentFrameNo = 1;
    let queueList = [];
    let attempt = 3;
    let currentLevel = 1;
    const maxLevel = 20;

    const levelParams = generateLevelParams();

    function generateLevelParams() {
        const params = [];
        let frames = 10;
        let slots = 3;

        for (let i = 1; i <= 20; i++) {
            params.push({ totalFrame: frames, pageSlot: slots });
            frames++;
            if (frames > 20) {
                frames = 10;
                slots++;
                if (slots > 5) {
                    endGame();
                }
            }
        }

        return params;
    }

    function endGame() {
        alert('No more levels');
    }

    startBtn.addEventListener('click', startGame);
    continueButton.addEventListener('click', proceedToNextLevel);
    restartButton.addEventListener('click', restartGame);

    function restartGame() {
        gameOverModal.style.display = 'none';
        resetGameVariables();
        startGame();
    }

    function resetGameVariables() {
        totalFrame = 10;
        pageSlot = 3;
        currentFrameNo = 1;
        queueList = [];
        attempt = 3;
        currentLevel = 1;
    }

    function startGame() {
        startScreen.style.display = 'none';
        resetGameVariables();
        updateGameParameters();
        main(); // Start the game
    }

    function proceedToNextLevel() {
        nextLevelModal.style.display = 'none';
        increaseLevel();
        main(); // Restart the game with updated parameters
    }

    function updateGameParameters() {
        const params = levelParams[currentLevel - 1]; // Adjust index since levels start from 1
        totalFrame = params.totalFrame;
        pageSlot = params.pageSlot;
    }

    function increaseLevel() {
        currentLevel++;
        updateGameParameters();
    }

    function main() {
        playBGM();
        currentFrameNo = 1;
        generateQueue(totalFrame);
        generateFrame(totalFrame, pageSlot);
        generatePage(pageSlot);
        setInitialFrame(pageSlot);
    }

    function generateQueue(numberOfFrame) {
        queueContainer.innerHTML = ''; // Clear existing queue
        queueList = generateQueueList(numberOfFrame);

        for (let i = 0; i < numberOfFrame; i++) {
            const queueItem = document.createElement('div');
            queueItem.classList.add('queueItem');
            queueItem.id = 'queueItem' + (i + 1);
            queueItem.dataset.pageId = queueList[i];
            queueItem.textContent = queueList[i];

            queueContainer.appendChild(queueItem);
        }
    }

    function generateQueueList(length) {
        const list = [];

        // Generate unique values for the first 5 indices
        for (let i = 0; i < 5; i++) {
            let uniqueValue;
            do {
                uniqueValue = Math.floor(Math.random() * 7);
            } while (list.includes(uniqueValue)); // Check if the value already exists
            list.push(uniqueValue);
        }

        // Fill the rest of the list with random values
        for (let i = 5; i < length; i++) {
            list.push(Math.floor(Math.random() * 7));
        }

        return list;
    }

    function generateFrame(numberOfFrame, numberOfPage) {
        frameContainer.innerHTML = ''; // Clear existing frames

        for (let i = 0; i < numberOfFrame; i++) {
            const frame = document.createElement('div');
            frame.classList.add('frame');
            frame.id = 'frame' + (i + 1);

            // Generate pages in the frame
            for (let j = 0; j < numberOfPage; j++) {
                const framePage = document.createElement('div');
                framePage.classList.add('framePage');
                framePage.id = frame.id + '_page' + (j + 1);
                framePage.dataset.pageIndex = j + 1;
                framePage.dataset.pageId = '-';
                framePage.textContent = '-';

                frame.appendChild(framePage);
            }

            frameContainer.appendChild(frame);
        }
    }

    function generatePage(numberOfPage) {
        pageContainer.innerHTML = ''; // Clear existing pages
        for (let i = 0; i < numberOfPage; i++) {
            const page = document.createElement('div');
            page.classList.add('page');
            page.id = 'page' + (i + 1);
            page.dataset.pageId = '-';
            page.textContent = '-'; // Add some text to identify the page
            page.addEventListener('click', () => handlePageClick(page.id)); // Add click event listener
            pageContainer.appendChild(page);
        }
    }

    function handlePageClick(page) {
        console.log('Page clicked:', page);

        const clickedPage = document.getElementById(page);
        const currentFrame = document.getElementById('frame' + currentFrameNo);
        const currentQueueItem = document.getElementById('queueItem' + currentFrameNo);

        const queueItemId = currentQueueItem.dataset.pageId;
        let framePages = currentFrame.querySelectorAll('.framePage');
        let pages = pageContainer.querySelectorAll('.page');
        let pageList = [];

        // Check if the page is valid for the current queue item
        if ((clickedPage.dataset.pageId === currentQueueItem.dataset.pageId || checkAge(page)) && currentQueueItem) {
            if (clickedPage.dataset.pageId !== currentQueueItem.dataset.pageId) {
                if (isUniqueOnPage(currentQueueItem.dataset.pageId)) {
                    clickedPage.textContent = currentQueueItem.dataset.pageId;
                    clickedPage.dataset.pageId = currentQueueItem.dataset.pageId;
                    clickedPage.dataset.age = 0;
                } else {
                    attempt--;
                    if (attempt === 0) {
                        gameOver();
                    }
                    return;
                }
            }

            // Update age for all pages
            pages.forEach(page => {
                pageList.push(page.dataset.pageId);
                page.dataset.age++;
            });

            // Update the frame pages with the new page list
            let i = 0;
            framePages.forEach(framePage => {
                framePage.textContent = pageList[i];
                framePage.dataset.pageId = pageList[i++];
            });

            currentFrameNo++;

            if (currentFrameNo > totalFrame) {
                playNextLevelSound();
                nextLevelModal.style.display = 'block';
            }
        } else {
            attempt--;
            if (attempt === 0) {
                gameOver();
            }
        }
    }

    function gameOver() {
        playGameOverSound();
        gameOverModal.style.display = 'block';
    }

    function isUniqueOnPage(pageId) {
        let pages = document.querySelectorAll('.page');
        for (let page of pages) {
            if (page.dataset.pageId === pageId) {
                return false;
            }
        }
        return true;
    }

    function setInitialFrame(length) {
        let frameTemp = Array(length).fill('-');

        for (let i = 0; i < pageSlot; i++) {
            const currentFrame = document.getElementById('frame' + currentFrameNo);
            frameTemp[i] = queueList[i];
            console.log(frameTemp);
            let framePages = currentFrame.querySelectorAll('.framePage');
            let j = 0;
            framePages.forEach(framePage => {
                framePage.textContent = frameTemp[j];
                framePage.dataset.pageId = frameTemp[j++];
            });

            currentFrameNo++;
        }

        let pages = document.querySelectorAll('.page');
        let k = 0;
        pages.forEach(page => {
            page.textContent = frameTemp[k];
            page.dataset.pageId = frameTemp[k];
            page.dataset.age = pageSlot - k;
            console.log(page.dataset.age);
            k++;
        });
    }

    function checkAge(id) {
        let maxAge = -Infinity;
        let pages = document.querySelectorAll('.page');
        pages.forEach(page => {
            let age = parseInt(page.dataset.age);
            if (age > maxAge) {
                maxAge = age;
            }
        });
        return parseInt(document.getElementById(id).dataset.age) === maxAge;
    }

    // MODAL & BGM START
    const bgm = document.getElementById("bgm");
    const nextLevelSound = document.getElementById('next-level-sound');
    const gameOverSound = document.getElementById('game-over-sound');
    const muteBtn = document.getElementById("mute-btn");
    const pauseModal = document.getElementById('pauseModal');
    const pauseBtn = document.getElementById("pause-button");
    const resumeBtn = document.getElementById('resume-btn');
    const quitBtn = document.querySelectorAll('.quit-btn');

    pauseBtn.addEventListener("click", showPauseModal);
    resumeBtn.addEventListener("click", resumeGame);
    quitBtn.forEach(btn => {
        btn.addEventListener("click", quitGame);
    });
    muteBtn.addEventListener("click", function () {
        if (bgm.muted) {
            bgm.muted = false;
            muteBtn.textContent = "Mute";
        } else {
            bgm.muted = true;
            muteBtn.textContent = "Unmute";
        }
    });

    // MAIN BGM
    function playBGM() {
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

    // PAUSE MODAL END
});
