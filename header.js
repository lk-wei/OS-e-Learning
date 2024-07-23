let lastScrollTop = 0;
navbar = document.getElementById("header-container");
window.addEventListener("scroll",function(){
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if(scrollTop>lastScrollTop){
        navbar.style.top = "-108px";
    }else{
        navbar.style.top = "0";
    }
    lastScrollTop = scrollTop;
})

// Different Roles, Different Features
const navLinksByRole = {
    Admin: [
        { href: "user-management.php", text: "User Management" },
        { href: "feedback-management.php", text: "Feedback Management" },
    ],
    Student: [
        { href: "student-dashboard.php", text: "Dashboard" },
        { href: "studentfeedback.php", text: "Feedback" },
        { href: "leaderboard.php", text: "Leaderboard" }
    ],
    Lecturer: [
        { href: "lecturemodule.php", text: "Questionnaire" },
        { href: "leaderboard.php", text: "Leaderboard" }
    ],
    Guardian: [
        { href: "studentfeedback.php", text: "Feedback" },
        { href: "guardiancheck.php", text: "Check Student" }
    ],
    guest: []
};

function updateNavLinks(role) {
    // Check if role is empty and set it to 'guest' in that case
    role = role || 'guest';
    const navLinks = navLinksByRole[role]; // This will now default to guest if role is empty
    const navElement = document.querySelector('.nav-links > ul');
    navElement.innerHTML = '';

    navLinks.forEach(link => {
        navElement.innerHTML += `<li><a href="${link.href}">${link.text}</a></li>`;
    });
}

document.addEventListener('DOMContentLoaded', function() {
    let userRoleElement = document.getElementById('userRole');
    if (userRoleElement) {
        let userRole = userRoleElement.getAttribute('data-role');
        console.log(userRole);
        updateNavLinks(userRole);
    }
});