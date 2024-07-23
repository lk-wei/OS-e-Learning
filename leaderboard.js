const players = [
    { rank: 1, name: "Player 1", score: 520 },
    { rank: 2, name: "Player 2", score: 1314 },
    { rank: 3, name: "Player 3", score: 5000 },
    { rank: 4, name: "Player 4", score: 1000 },
    { rank: 5, name: "Player 5", score: 3000 }
];

function generateLeaderboard() {
    const leaderboardEntries = document.getElementById('leaderboard-entries');
    leaderboardEntries.innerHTML = ''; // Clear existing entries

    // Sort players by score in descending order
    players.sort((a, b) => b.score - a.score);

    players.forEach((player, index) => {
        player.rank = index + 1; // Update rank based on sorted order

        const entry = document.createElement('div');
        entry.classList.add('leaderboard-entry');

        const rank = document.createElement('div');
        rank.classList.add('rank');
        rank.innerText = player.rank;

        const name = document.createElement('div');
        name.classList.add('name');
        name.innerText = player.name;

        const score = document.createElement('div');
        score.classList.add('score');
        score.innerText = player.score;

        entry.appendChild(rank);
        entry.appendChild(name);
        entry.appendChild(score);

        leaderboardEntries.appendChild(entry);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    generateLeaderboard();

    const backButton = document.getElementById('back-button');
    backButton.addEventListener('click', () => {
        window.history.back();
    });

    const refreshButton = document.getElementById('refresh-button');
    refreshButton.addEventListener('click', () => {
        generateLeaderboard();
    });
});
