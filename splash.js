document.addEventListener("DOMContentLoaded", function() {
  // Simulate a delay for demonstration purposes (you can replace this with actual loading tasks)
  setTimeout(function() {
    var wrapper = document.querySelector('.wrapper');
    var splashScreen = document.querySelector('.splash-screen');
    var mainContent = document.querySelector('.main-content');

    // Hide splash screen and show main content
    wrapper.style.display='none';
    splashScreen.style.display = 'none';
    mainContent.style.display = 'block';

  },3000);
});
