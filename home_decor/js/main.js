// Smooth Scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
document.querySelector('form').addEventListener('submit', function(event) {
    let valid = true;
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    if (!email.value.includes('@')) {
        alert('Please enter a valid email address.');
        valid = false;
    }

    if (password.value.length < 6) {
        alert('Password must be at least 6 characters long.');
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
    }
});
