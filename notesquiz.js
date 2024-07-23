document.addEventListener('DOMContentLoaded', function () {
    const quizButton = document.getElementById('quiz-btn');
    const notesButton = document.getElementById('notes-btn');
    const quizSection = document.querySelector('.quiz');
    const notesSection = document.querySelector('.notes');
    const progressionButton = document.getElementById('progression-btn');
    const undoButton = document.getElementById('undo-button');
    
    quizButton.addEventListener('click', function () {
        quizSection.classList.add('active');
        notesSection.classList.remove('active');
        progressionButton.textContent = 'Progression';
        progressionButton.onclick = null; // Remove any previous onclick handler
    });

    notesButton.addEventListener('click', function () {
        notesSection.classList.add('active');
        quizSection.classList.remove('active');
        progressionButton.textContent = '+Add';
        progressionButton.onclick = function() {
            window.location.href = 'studentnotes.php';
        };
    });

    // Update this event listener to redirect to studentmodule.php
    undoButton.addEventListener('click', function () {
        window.location.href = 'studentmodule.php';
    });

    var saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', function() {
        window.location.href = 'notesquiz.php';
    });
});

