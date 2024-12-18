// function toggleMenu() {

//     const nav = document.querySelector('nav ul');
//     if (nav) {
//         nav.classList.toggle('active'); 
//     }
// }

// const menuButton = document.querySelector('.menu-button'); 
// if (menuButton) {
//     menuButton.addEventListener('click', toggleMenu);
// }
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Display confirmation message
    document.getElementById('confirmation').style.display = 'block';

    // Optionally, you can also reset the form
    this.reset();
});