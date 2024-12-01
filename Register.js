document.addEventListener('DOMContentLoaded', function () {
    // Get the form element
    const form = document.getElementById('signupForm');
    
    // Get the toast element
    const toast = document.querySelector('.toast.jam');
    const closeBtn = document.querySelector('.close');
    
    // Attach a submit event listener to the form
    form.addEventListener('submit', function(event) {
        // Prevent the default form submission (reloading)
        event.preventDefault();
        
        // Get all input fields
        const email = document.getElementById('mail').value;
        const password = document.getElementById('password').value;
        const age = document.querySelector('input[name="user_age"]:checked');
        const job = document.getElementById('job').value;
        
        // Validate if required fields are filled
        if (!email || !password || !age || !job) {
            // Show a toast message if validation fails
            toast.textContent = "Please fill in all fields.";
            toast.setAttribute('aria-hidden', 'false');
            toast.classList.add('on');

            setTimeout(function () {
                toast.classList.remove('on');
                toast.setAttribute('aria-hidden', 'true');
            }, 3000);

            return;
        }
        
        // If everything is valid, show the success toast
        toast.textContent = "Registered Successfully!";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('on');
        
        // Optionally reset the form
        form.reset();
        
        // Close the toast after 3 seconds
        setTimeout(function () {
            toast.classList.remove('on');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
    });
    
    // Close the toast when the close button is clicked
    closeBtn.addEventListener('click', function () {
        toast.classList.remove('on');
        toast.setAttribute('aria-hidden', 'true');
    });
});
