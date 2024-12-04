// Grab the form and toast elements
const form = document.getElementById("signupForm");
const toast = document.getElementById("toastMessage");

// Add event listener for form submission
form.addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent the form from submitting normally
    
    // Collect form values
    const email = form.user_email.value.trim();
    const password = form.user_password.value.trim();
    const age = form.user_age.value;
    const job = form.user_job.value;
    const interests = form.user_interest ? form.user_interest : [];

    // Validate form fields
    if (!email || !password || !age || !job) {
        // Show error toast for missing fields
        toast.textContent = "Please fill in all fields.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('on');
        
        setTimeout(function () {
            toast.classList.remove('on');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
        return;  // Stop form submission if validation fails
    }

    // Optional: Add password validation here (length, special characters, etc.)
    if (password.length < 6) {
        toast.textContent = "Password must be at least 6 characters.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('on');
        
        setTimeout(function () {
            toast.classList.remove('on');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
        return;
    }

    // If validation passes, prepare form data and send via AJAX
    const formData = new FormData(form);

    fetch('/php/Process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Check the response from the server
        if (data.trim() === "success") {
            // Show success toast if registration is successful
            toast.textContent = "Registered Successfully!";
            toast.setAttribute('aria-hidden', 'false');
            toast.classList.add('on');
        } else {
            // Show error toast if registration fails
            toast.textContent = "Registration Failed. Please try again.";
            toast.setAttribute('aria-hidden', 'false');
            toast.classList.add('on');
        }

        setTimeout(function () {
            toast.classList.remove('on');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
    })
    .catch(error => {
        // Show error toast if there's an issue with the AJAX request
        toast.textContent = "Error registering. Please try again later.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('on');
        
        setTimeout(function () {
            toast.classList.remove('on');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
    });
});
