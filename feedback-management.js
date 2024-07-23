function generateStarRating(rating) {
    const starsContainer = document.createElement('div');
    starsContainer.className = 'star-rating';
    for (let i = 0; i < 5; i++) {
        const starSpan = document.createElement('span');
        starSpan.className = 'star';
        starSpan.innerHTML = '&#9733;'; 
        if (i < rating) { 
            starSpan.classList.add('selected');
        }
        starsContainer.appendChild(starSpan);
    }
    return starsContainer.outerHTML; 
}

function loadAndDisplayFeedbacks() {
    fetch('fetchData.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const mainFeedbackContainer = document.querySelector('.feedback-container');
            mainFeedbackContainer.innerHTML = ''; // Clear existing feedbacks

            data.topFeedbacks.forEach(feedback => {
                const feedbackElement = document.createElement('div');
                feedbackElement.classList.add('feedback');

                feedbackElement.setAttribute('data-feedback-id', feedback.Feedback_ID);

                const feedbackHeaderDiv = document.createElement('div');
                feedbackHeaderDiv.className = 'feedback-header';

                const userInfoDiv = document.createElement('div');
                userInfoDiv.className = 'user-info';
                
                const feedbackContentDiv = document.createElement('div');
                feedbackContentDiv.className = 'feedback-content';

                const stars = generateStarRating(feedback.Rating);
                userInfoDiv.innerHTML = `
                                        <span class="name">Anonymous</span>
                                        <div class="star-rating">${stars}</div>
                                        `;
                
                feedbackContentDiv.innerHTML = `${feedback.Reviews}`;
                feedbackHeaderDiv.appendChild(userInfoDiv);

                // Create a feedback-actions div
                const feedbackActionsDiv = document.createElement('div');
                feedbackActionsDiv.className = 'feedback-actions';
                feedbackActionsDiv.style.display = 'none'; // Initially hidden

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.className = 'delete-feedback-btn';                
                deleteButton.onclick = function(event) {
                    console.log('Delete button clicked');
                    event.stopPropagation();
                    const feedbackId = feedbackElement.getAttribute('data-feedback-id');
                    fetch('deleteFeedback.php', {
                        method: 'POST', // or 'DELETE', depending on your server setup
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `feedbackId=${feedbackId}`
                    })
                    .then(response => response.text()) // First, get the response as text
                    .then(text => {
                        return JSON.parse(text); // Then, parse it as JSON
                    })
                    .then(data => {
                        if(data.success) {
                            // Remove the feedback element from the DOM or refresh the feedback list
                            loadAndDisplayFeedbacks();
                        } else {
                            // Handle failure
                            console.error('Failed to delete feedback');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }

                feedbackActionsDiv.appendChild(deleteButton);

                feedbackElement.appendChild(feedbackHeaderDiv);
                feedbackElement.appendChild(feedbackContentDiv);
                feedbackElement.appendChild(feedbackActionsDiv);
                feedbackElement.onclick = function() { showFeedbackActions(this); };

                mainFeedbackContainer.appendChild(feedbackElement);
            });

            const positiveFeedbackPercentage = data.positivePercentage;
            const positiveFeedback = document.querySelector('.positive-feedback');
            positiveFeedback.style.width = '0'; // Reset width to 0
            positiveFeedback.style.animation = 'none'; // Reset animation
            // Trigger reflow to restart the animation
            positiveFeedback.classList.add('reset');
            // Force reflow
            positiveFeedback.offsetHeight;
            // Animate
            positiveFeedback.classList.replace('reset', 'animate');
            positiveFeedback.style.width = positiveFeedbackPercentage + '%';
            positiveFeedback.style.transition = 'all 2s ease';
        
            document.querySelector('.feedback-count p').textContent = data.totalFeedbacks;
            document.querySelector('.positive-reviews p').textContent = data.positiveReviews;
            document.querySelector('.negative-reviews p').textContent = data.negativeReviews;
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    loadAndDisplayFeedbacks();
});

function showFeedbackActions(feedbackItem) {
    let feedbackActions = feedbackItem.querySelector('.feedback-actions');

    // Toggle the display property
    if (feedbackActions.style.display === 'none') {
        feedbackActions.style.display = 'block';
    } else {
        feedbackActions.style.display = 'none';
    }
}