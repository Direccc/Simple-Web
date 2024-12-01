$(function () {
    $('.show').click(function() {
      $('.toast').addClass('on');
    });
  
    $('.close').click(function() {
      $('.toast').removeClass('on');
    });
  });


// Get the form element
const form = document.getElementById('signupForm');

// Attach a submit event listener to the form
form.addEventListener('submit', function(event) {
    // Prevent the default form submission (reloading)
    event.preventDefault();

    // Show your toast notification or any other message
    const toast = document.querySelector('.toast.jam');
    toast.setAttribute('aria-hidden', 'false');

    // Optionally reset the form
    form.reset();
});
